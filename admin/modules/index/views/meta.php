<?php
/**
 * @filesource modules/index/views/meta.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Index\Meta;

use Kotchasan\Html;
use Kotchasan\Language;

/**
 * ตั้งค่า SEO & Social.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class View extends \Gcms\Adminview
{
    /**
     * module=meta.
     *
     * @param object $config
     *
     * @return string
     */
    public function render($config)
    {
        // form
        $form = Html::create('form', array(
            'id' => 'setup_frm',
            'class' => 'setup_frm',
            'autocomplete' => 'off',
            'action' => 'index.php/index/model/meta/submit',
            'onsubmit' => 'doFormSubmit',
            'ajax' => true,
            'token' => true,
        ));
        $fieldset = $form->add('fieldset', array(
            'titleClass' => 'icon-google',
            'title' => '{LNG_Google}',
        ));
        // google_site_verification
        $fieldset->add('text', array(
            'id' => 'google_site_verification',
            'labelClass' => 'g-input icon-edit',
            'itemClass' => 'item',
            'label' => '{LNG_Site verification code}',
            'comment' => '{LNG_&lt;meta name="google-site-verification" content="<em>xxxxxxxxxx</em>" /&gt;}',
            'value' => isset($config->google_site_verification) ? $config->google_site_verification : '',
        ));
        // google_client_id
        $fieldset->add('text', array(
            'id' => 'google_client_id',
            'labelClass' => 'g-input icon-edit',
            'itemClass' => 'item',
            'label' => '{LNG_Google client ID} <a class=icon-help href="https://gcms.in.th/index.php?module=howto&id=374" target=_blank></a>',
            'comment' => '<em>xxxxxxxxxx</em>.apps.googleusercontent.com',
            'value' => isset($config->google_client_id) ? $config->google_client_id : '',
        ));
        // amp
        $fieldset->add('select', array(
            'id' => 'amp',
            'labelClass' => 'g-input icon-amp',
            'itemClass' => 'item',
            'label' => '{LNG_Accelerated mobile pages}',
            'options' => \Kotchasan\Language::get('BOOLEANS'),
            'value' => isset($config->amp) ? $config->amp : 0,
        ));
        $fieldset = $form->add('fieldset', array(
            'titleClass' => 'icon-bing',
            'title' => '{LNG_Bing}',
        ));
        // msvalidate
        $fieldset->add('text', array(
            'id' => 'msvalidate',
            'labelClass' => 'g-input icon-edit',
            'itemClass' => 'item',
            'label' => '{LNG_Site verification code}',
            'comment' => '{LNG_&lt;meta name="msvalidate.01" content="<em>xxxxxxxxxx</em>" /&gt;}',
            'value' => isset($config->msvalidate) ? $config->msvalidate : '',
        ));
        $fieldset = $form->add('fieldset', array(
            'titleClass' => 'icon-facebook',
            'title' => '{LNG_Facebook}',
        ));
        // facebook_appId
        $fieldset->add('text', array(
            'id' => 'facebook_appId',
            'labelClass' => 'g-input icon-edit',
            'itemClass' => 'item',
            'label' => '{LNG_App ID} <a class=icon-help href="https://gcms.in.th/index.php?module=howto&id=214"></a>',
            'value' => isset($config->facebook_appId) ? $config->facebook_appId : '',
        ));
        // site_logo
        $fieldset->add('file', array(
            'id' => 'site_logo',
            'labelClass' => 'g-input icon-upload',
            'itemClass' => 'item',
            'label' => '{LNG_Photos for sharing}',
            'comment' => Language::replace('Browse image uploaded, type :type size :width*:height pixel', array(':type' => 'jpg', ':width' => 800, ':height' => 800)),
            'dataPreview' => 'logoImage',
            'previewSrc' => is_file(ROOT_PATH.DATA_FOLDER.'image/site_logo.jpg') ? WEB_URL.DATA_FOLDER.'image/site_logo.jpg' : WEB_URL.'skin/img/blank.gif',
        ));
        // delete_site_logo
        $fieldset->add('checkbox', array(
            'id' => 'delete_site_logo',
            'itemClass' => 'subitem',
            'label' => '{LNG_Remove} {LNG_Photos for sharing}',
            'value' => 1,
        ));
        $fieldset = $form->add('fieldset', array(
            'titleClass' => 'icon-line',
            'title' => '{LNG_LINE Notify}',
        ));
        // line_api_key
        $fieldset->add('text', array(
            'id' => 'line_api_key',
            'labelClass' => 'g-input icon-password',
            'itemClass' => 'item',
            'label' => '{LNG_Access token} <a class=icon-help href="https://gcms.in.th/index.php?module=howto&id=367" target=_blank></a>',
            'comment' => '{LNG_Generate access token (For developers)}',
            'value' => isset($config->line_api_key) ? $config->line_api_key : '',
        ));
        $fieldset = $form->add('fieldset', array(
            'class' => 'submit',
        ));
        // submit
        $fieldset->add('submit', array(
            'class' => 'button save large icon-save',
            'value' => '{LNG_Save}',
        ));

        return $form->render();
    }
}
