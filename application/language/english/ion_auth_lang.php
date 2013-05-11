<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.14.2010
*
* Description:  English language file for Ion Auth messages and errors
*
*/

// Account Creation
$lang['account_creation_successful'] 	  	 = 'החשבון הוצר בהצלחה';
$lang['account_creation_unsuccessful'] 	 	 = 'יצירת חשבון נכשלה';
$lang['account_creation_duplicate_email'] 	 = 'האימייל נמצא בשימוש או לא תקין';
$lang['account_creation_duplicate_username'] = 'שם משתמש נמצא בשימוש או אינו תקין';

// Password
$lang['password_change_successful'] 	 	 = 'הסיסמא שונתה בהצלחה';
$lang['password_change_unsuccessful'] 	  	 = 'שינוי הסיסמא נכשל';
$lang['forgot_password_successful'] 	 	 = 'הסיסמה אופסה. נשלח אימייל עם סיסמא חדשה';
$lang['forgot_password_unsuccessful'] 	 	 = 'לא מצליח לאפס סיסמא';

// Activation
$lang['activate_successful'] 		  	     = 'חשבון הופעל';
$lang['activate_unsuccessful'] 		 	     = 'לא מצליח להפעיל חשבון';
$lang['deactivate_successful'] 		  	     = 'החשבון אינו פעיל';
$lang['deactivate_unsuccessful'] 	  	     = 'לא מצליח לכבות את החשבון';
$lang['activation_email_successful'] 	  	 = 'אימייל אימות נשלח';
$lang['activation_email_unsuccessful']   	 = 'שליחת אימייל אימות נכשלה';

// Login / Logout
$lang['login_successful'] 		  	         = 'התחבר בהצלחה';
$lang['login_unsuccessful'] 		  	     = 'התחברות שגוייה';
$lang['login_unsuccessful_not_active'] 		 = 'חשבון אינו פעיל';
$lang['login_timeout']                       = 'נעול זמנית ץ נסה שוב מאוחר יותר';
$lang['logout_successful'] 		 	         = 'התנתק בהצלחה';

// Account Changes
$lang['update_successful'] 		 	         = 'פרטי החשבון עודכנו בהצלחה';
$lang['update_unsuccessful'] 		 	     = 'עדכון החשבון נכשל';
$lang['delete_successful']               = 'משתמש נמחק';
$lang['delete_unsuccessful']           = 'מחיקת משתמש נכשלה';

// Groups
$lang['group_creation_successful']  = 'הקבוצה נוצרה בהצלחה';
$lang['group_already_exists']       = 'שם הקבוצה קיים';
$lang['group_update_successful']    = 'פרטי הקבוצה עודכנו';
$lang['group_delete_successful']    = 'הקבוצה נחמקה';
$lang['group_delete_unsuccessful'] 	= 'מחיקת קבוצה נכשלה';
$lang['group_name_required'] 		= 'עלייך למלא את שם הקבוצה';

// Email Subjects
$lang['email_forgotten_password_subject']    = 'אימות שכחתי סיסמא';
$lang['email_new_password_subject']          = 'סיסמא חדשה';
$lang['email_activation_subject']            = 'הפעלת חשבון';