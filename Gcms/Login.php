<?php
/**
 * @filesource Gcms/Login.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Gcms;

use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * คลาสสำหรับตรวจสอบการ Login.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Login extends \Kotchasan\Login
{
    /**
     * ตรวจสอบความสามารถในการเข้าระบบแอดมิน
     * คืนค่าข้อมูลสมาชิก (แอเรย์) ถ้าสามารถเข้าระบบแอดมินได้ ไม่ใช่คืนค่า null.
     *
     * @return array|null
     */
    public static function adminAccess()
    {
        $login = self::isMember();

        return isset($login['active']) && $login['active'] == 1 ? $login : null;
    }

    /**
     * ฟังก์ชั่นตรวจสอบการ login และบันทึกการเข้าระบบ
     * เข้าระบบสำเร็จคืนค่าแอเรย์ข้อมูลสมาชิก, ไม่สำเร็จ คืนค่าข้อความผิดพลาด.
     *
     * @param array $params ข้อมูลการ login ที่ส่งมา $params = array('username' => '', 'password' => '');
     *
     * @return string|array
     */
    public function checkLogin($params)
    {
        // ตรวจสอบสมาชิกกับฐานข้อมูล
        $login_result = self::checkMember($params);
        if (is_array($login_result)) {
            // ip ที่ login
            $ip = self::$request->getClientIp();
            // current session
            $session_id = session_id();
            // ลบ password
            unset($login_result['password']);
            if (self::$cfg->member_only) {
                // token
                $login_result['token'] = sha1(uniqid().$login_result['id'].$session_id);
            }
            // อัปเดทการเยี่ยมชม
            if ($session_id != $login_result['session_id']) {
                // update visited
                ++$login_result['visited'];
                $save = array(
                    'session_id' => $session_id,
                    'visited' => $login_result['visited'],
                    'lastvisited' => time(),
                    'ip' => $ip,
                    'token' => $login_result['token'],
                );
            } elseif (self::$cfg->member_only) {
                $save = array(
                    'token' => $login_result['token'],
                );
            }
            if (!empty($save)) {
                // บันทึกการเข้าระบบ
                \Kotchasan\Model::createQuery()
                    ->update('user')
                    ->set($save)
                    ->where((int) $login_result['id'])
                    ->execute();
            }
        }

        return $login_result;
    }

    /**
     * ฟังก์ชั่นตรวจสอบสมาชิกกับฐานข้อมูล
     * คืนค่าข้อมูลสมาชิก (array) ไม่พบคืนค่าข้อความผิดพลาด (string).
     *
     * @param array $params
     *
     * @return array|string
     */
    public static function checkMember($params)
    {
        // query Where
        $where = array();
        foreach (self::$cfg->login_fields as $field) {
            $where[] = array("U.{$field}", $params['username']);
        }
        $query = \Kotchasan\Model::createQuery()
            ->select()
            ->from('user U')
            ->where($where, 'OR')
            ->order('U.status DESC')
            ->toArray();
        $login_result = null;
        foreach ($query->execute() as $item) {
            if (isset($params['password']) && $item['password'] == sha1($params['password'].$item['salt'])) {
                // ตรวจสอบรหัสผ่าน
                $login_result = $item;
                break;
            } elseif (isset($params['token']) && $params['token'] == $item['token']) {
                // ตรวจสอบ token
                $login_result = $item;
                break;
            }
        }
        if ($login_result === null) {
            // user หรือ password ไม่ถูกต้อง
            self::$login_input = isset($item) ? 'password' : 'username';

            return isset($item) ? Language::replace('Incorrect :name', array(':name' => Language::get('Password'))) : Language::get('not a registered user');
        } elseif (!empty($login_result['activatecode'])) {
            // ยังไม่ได้ activate
            self::$login_input = 'username';

            return Language::get('No confirmation email, please check your e-mail');
        } elseif (!empty($login_result['ban'])) {
            // ติดแบน
            self::$login_input = 'username';

            return Language::get('Members were suspended');
        } else {
            // permission
            $login_result['permission'] = empty($login_result['permission']) ? array() : explode(',', trim($login_result['permission'], " \t\n\r\0\x0B,"));

            return $login_result;
        }
    }

    /**
     * ตรวจสอบความสามารถในการตั้งค่า
     * แอดมินสูงสุด (status=1) ทำได้ทุกอย่าง
     * คืนค่าข้อมูลสมาชิก (แอเรย์) ถ้าไม่สามารถทำรายการได้คืนค่า null.
     *
     * @param array        $login
     * @param array|string $permission
     *
     * @return array|null
     */
    public static function checkPermission($login, $permission)
    {
        if (!empty($login)) {
            if ($login['status'] == 1) {
                // แอดมิน
                return $login;
            } elseif (!empty($permission)) {
                if (is_array($permission)) {
                    foreach ($permission as $item) {
                        if (in_array($item, $login['permission'])) {
                            // มีสิทธิ์
                            return $login;
                        }
                    }
                } elseif (in_array($permission, $login['permission'])) {
                    // มีสิทธิ์
                    return $login;
                }
            }
        }
        // ไม่มีสิทธิ

        return null;
    }

    /**
     * ฟังก์ชั่นส่งอีเมลลืมรหัสผ่าน.
     */
    public function forgot(Request $request)
    {
        // ค่าที่ส่งมา
        $username = $request->post('login_username')->url();
        if (empty($username)) {
            if ($request->post('action')->toString() === 'forgot') {
                self::$login_message = Language::get('Please fill in');
            }
        } else {
            self::$login_params['username'] = $username;
            // ชื่อฟิลด์สำหรับตรวจสอบอีเมล ใช้ฟิลด์แรกจาก config
            $field = reset(self::$cfg->login_fields);
            // Model
            $model = new \Kotchasan\Model();
            // ตาราง user
            $table = $model->getTableName('user');
            // ค้นหาอีเมล
            $search = $model->db()->first($table, array(array($field, $username), array('social', 0)));
            if ($search === false) {
                self::$login_message = Language::get('not a registered user');
            } else {
                // สุ่มรหัสผ่านใหม่
                $password = \Kotchasan\Text::rndname(6);
                // ข้อมูลอีเมล
                $replace = array(
                    '/%PASSWORD%/' => $password,
                    '/%EMAIL%/' => $search->$field,
                );
                // send mail
                $err = \Gcms\Email::send(3, 'member', $replace, $search->$field);
                if (!$err->error()) {
                    // อัปเดทรหัสผ่านใหม่
                    $save = array(
                        'salt' => uniqid(),
                    );
                    $save['password'] = sha1($password.$save['salt']);
                    $model->db()->update($table, (int) $search->id, $save);
                    // คืนค่า
                    self::$login_message = Language::get('Your message was sent successfully');
                    self::$request = $request->withQueryParams(array('action' => 'login'));
                } else {
                    // ไม่สำเร็จ
                    self::$login_message = $err->getErrorMessage();
                }
            }
        }
    }

    /**
     * ฟังก์ชั่นตรวจสอบว่า เป็นสมาชิกตัวอย่างหรือไม่
     * คืนค่าข้อมูลสมาชิก (แอเรย์) ถ้าไม่ใช่สมาชิกตัวอย่าง, null ถ้าเป็นสมาชิกตัวอย่างและเปิดโหมดตัวอย่างไว้.
     *
     * @param array|null $login
     *
     * @return array|null
     */
    public static function notDemoMode($login)
    {
        return $login && !empty($login['social']) && self::$cfg->demo_mode ? null : $login;
    }
}
