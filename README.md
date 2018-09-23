# GCMS 13.3.0

GCMS เป็น Ajax CMS สมบูรณ์แบบ ที่พัฒนาโดยคนไทยทั้งระบบ เพื่อให้การใช้งาน CMS แบบ Ajax เป็นเรื่องที่ง่ายขึ้น และแก้ปัญหาของ Ajax ที่เป็นที่กังวล ทั้งในเรื่องการรองรับหลายบราวเซอร์, การปิดการใช้งาน Javascript, การ Refresh หน้า, การ Bookmark, การใช้งานปุ่ม History ของบราวเซอร์ และที่สำคัญคือ SEO

GCMS เหมาะสมสำหรับการทำเว็บไซต์ทั่วไป ทั้งเว็บไซต์ส่วนบุคคล หน่วยงานราชการ หรือเว็บไซต์อื่นๆ ตั้งแต่ขนาดเล็ก ไปจนถึงเว็บไซต์ขนาดใหญ่ ด้วยการออกแบบที่เน้นอิสระในการปรับปรุงหน้าเว็บ ไม่มุ่งเน้นไปที่เว็บไซต์แบบใดแบบหนึ่งโดยเฉพาะ และมีคุณสมบัติเบื้องต้นต่อการออกแบบเว็บไซต์ทั่วไปได้ง่าย นอกจากนี้ GCMS ยังเหมาะสมเป็นอย่างยิ่ง สำหรับผู้ที่ชอบออกแบบเว็บด้วยตัวเอง ด้วยการใช้ GCMS เป็นพื้นฐานของเว็บเนื่องจาก GCMS มีระบบพื้นฐานครบถ้วน และออกแบบโมดูลตามความต้องการเพื่อใช้งานร่วมกับ GCMS ซึ่งทำให้ประหยัดเวลาในการออกแบบเว็บลงเป็นอย่างมาก

หากคุณมีข้อสงสัย ข้อเสนอแนะ หรือต้องการความช่วยเหลือเกี่ยวกับ GCMS คุณสามารถหาความช่วยเหลือนั้นได้ที่ https://goragod.com และคุณสามารถแสดงความคิดเห็นของคุณต่อ GCMS รวมถึงปัญหาในการใช้งาน ตลอดจนข้อผิดพลาดต่างๆ ของ GCMS ได้ ความคิดเห็นของคุณจะช่วยผมในการพัฒนา GCMS ให้ดียิ่งขึ้นในโอกาศต่อไป

* เว็บไซต์หลัก GCMS http://gcms.in.th
* ตัวอย่างเว็บไซต์ทั่วไป http://demo.gcms.in.th
* ตัวอย่างเว็บโรงเรียนหรือ อบต. http://school.gcms.in.th

*ข้อตกลงการนำ GCMS ไปใช้งาน*
* GCMS เป็น Ajax CMS ชนิด Open Source ที่แจกจ่ายให้กับทุกคนสามารถนำไปใช้งานได้ ฟรี โดยมีเงื่อนไขว่า ต้องติดข้อความหรือเครื่องหมายของผู้พัฒนาไว้เสมอ (https://goragod.com และ http://www.webshopready.com)
* ห้ามนำ GCMS หรือ ส่วนหนึ่งส่วนใดของ GCMS ไป จำหน่าย จ่าย แจก หรือ ใช้งานกับบุคคลที่สาม เว้นแต่จะได้รับความยินยอมจากผู้พัฒนา
* คุณสามารถพัฒนาต่อยอด เพิ่มเติม แก้ไข หรือ ดัดแปลง GCMS ได้เพื่อการใช้งานส่วนบุคคล โดยต้องติดข้อความหรือโลโกของผู้พัฒนาไว้เสมอไม่ว่าจะเปลี่ยนแปลงไปมากน้อยแค่ไหนก็ตาม
* คุณสามารถพัฒนา โมดูลเสริม หรือ วิดเจ็ท หรือ ส่วนประกอบอื่นใด (นอกจากที่มีแจกจ่ายโดยผู้พัฒนาอยู่แล้ว) เพื่อใช้หรือเพื่อจำหน่าย จ่าย แจกได้ โดยให้สิทธิ์เป็นของผู้พัฒนาเอง (ขายหรือแจกเฉพาะโมดูล)
* หากคุณต้องการนำ GCMS ไปใช้กับบุคลที่สาม หรือ เพื่อขาย หรือต้องการนำเครื่องหมายหรือข้อความของผู้พัฒนาออก คุณสามารถติดต่อกับผู้พัฒนาได้โดยตรง ตามที่อยู่ใน https://goragod.com

## การติดตั้งและอัปเกรด
* ดาวน์โหลดโค้ดทั้งหมดจาก Github
* การอัปเกรด ต้องดาวน์โหลด Theme ไปติดตั้งใหม่ด้วย
* แตกไฟล์และอัปโหลดไฟล์ทั้งหมดไปยัง Server
* ติดตั้งหรืออัปเกรด GCMS โดยเรียก http://domain.tld/install/ และทำตามขั้นตอนต่างๆที่ตัวอัปเกรดแจ้ง
* ทดสอบเรียกเว็บไซต์ โดยเข้าระบบแอดมิน
* ลบไดเร็คทอรี่ install/ ออก

ในกรณีที่เป็นการอัปเกรด หลังจากการอัปเกรดเสร็จสิ้น สมาชิกทุกคนจะต้องขอรหัสผ่านใหม่ หากแอดมินไม่สามารถเข้าระบบได้ ให้ดำเนินการดังนี้

เปิดตาราง xxx_user (xxx คือ prefix ของฐานข้อมูล) มองหารายการ id 1 (หรือรายการอีเมล์ของตัวเอง) แล้วกรอกค่าต่างๆด้านล่างลงในตาราง
* คอลัมน์ email ให้กรอก admin@localhost
* คอลัมน์ password ให้กรอก 378b16462af3df83bc996c94706d5edd1c750a7a
* คอลัมน์ salt ให้กรอก 5ba77fe459b43
จะสามารถเข้าระบบโดยใช้บัญชี อีเมล์ admin@localhost และรหัสผ่าน admin ได้ (หลังจากเข้าระบบได้แล้ว ให้เปลี่ยนอีเมล์และรหัสผ่านกลับเป็นเหมือนเดิม โดยดำเนินการบนระบบให้เรียบร้อยด้วย)


```
ตัวอัปเกรดไม่รองรับการอัปเกรดจาก GCMS เวอร์ชั่นต่ำกว่า 9.1.0 นะครับ โดยจะต้องทำการอัปเกรดให้เป็น 9.1.0 ก่อนถึงจะอัปเกรดให้เป็นเวอร์ชั่นล่าสุดได้
การอัปเกรดจาก GCMS 11.0.0 ขึ้นไป ให้ลบไดเร็คทอรี่ Gcms/ Kotchasan/ PDF/ Widgets/ admin/ ckeditor/ js/ modules/ ออก แล้วอัปโหลดไฟล์ทั้งหมดจากที่ดาวน์โหลดไป ไปแทนที่ เสร็จแล้วถึงเรียกตัวติดตั้ง
การอัปเกรดจาก GCMS 11.2.0 ขึ้นไป ให้อัปโหลดไฟล์ทั้งหมดจากที่ดาวน์โหลดไปแทนที่ไฟล์เดิมได้เลยเสร็จแล้วเรียกตัวติดตั้ง
```
