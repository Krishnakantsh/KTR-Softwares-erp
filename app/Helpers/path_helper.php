<?php


function base_url($path = '')
{
    return url(ltrim($path, '/'));
}


function asset_dir($path, $use = 'external')
{
    $relativePath = trim($path, '/');
    $absolutePath = public_path($relativePath);

    if (!is_dir($absolutePath)) {
        mkdir($absolutePath, 0755, true);
    }

    if ($use === 'internal') {
        return $absolutePath;
    }

    if ($use === 'relative') {
        return $relativePath;
    }

    if ($use === 'external') {
        return rtrim(base_url($relativePath), '/') . '/';
    }

    return null;
}

function get_file_url($path, $fileName)
{
    if (!$fileName) return null;

    return $path . $fileName;
}

function school_asset_dir($school_name, $path, $use = 'external')
{
    $school_name = trim($school_name, '/');
    $path        = trim($path, '/');

    $relativePath = 'assets/schools/' . $school_name . '/' . $path;

    return asset_dir($relativePath, $use);
}

function default_user_img()
{
    return base_url('assets/user_placeholder.png');
}

function default_blank_img()
{
    return base_url('assets/image_placeholder.png');
}

function student_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'student_photo', $use);
}


function fathers_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'fathers_photo', $use);
}

function mothers_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'mothers_photo', $use);
}

function guardian_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'guardian_photo', $use);
}

function aadhaar_card_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'aadhaar_card_photo', $use);
}

function character_certificate_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'character_certificate_photo', $use);
}

function transfer_certificate_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'transfer_certificate_photo', $use);
}

function birth_certificate_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'birth_certificate_photo', $use);
}

function registration_form_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'registration_form_photo', $use);
}

function other_document_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'other_document_photo', $use);
}

function fathers_aadhar_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'fathers_aadhar_photo', $use);
}

function mothers_aadhar_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'mothers_aadhar_photo', $use);
}


/*
|--------------------------------------------------------------------------
| School Common Documents
|--------------------------------------------------------------------------
*/

function school_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'school_official', $use);
}

function board_logo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'school_official', $use);
}

function principal_signature_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'school_official', $use);
}

function vice_principal_signature_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'school_official', $use);
}

function headmistress_signature_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'school_official', $use);
}

function manager_signature_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'school_official', $use);
}

function exam_incharge_signature_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'school_official', $use);
}

function school_stamp_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'school_official', $use);
}

function fee_qr_code_image_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'school_official', $use);
}

function header_image_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'school_official', $use);
}

function fee_report_header_image_url_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'school_official', $use);
}


/*
|--------------------------------------------------------------------------
| Homework
|--------------------------------------------------------------------------
*/

function homework_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'homework', $use);
}


/*
|--------------------------------------------------------------------------
| Study Material
|--------------------------------------------------------------------------
*/

function study_material_image_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'study_material/image', $use);
}

function study_material_pdf_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'study_material/pdf', $use);
}

function study_material_doc_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'study_material/doc', $use);
}

function study_material_ppt_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'study_material/ppt', $use);
}


/*
|--------------------------------------------------------------------------
| Payroll
|--------------------------------------------------------------------------
*/


function payroll_employee_pic_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'payroll/employee_pic', $use);
}

function payroll_aadhaar_card_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'payroll/aadhaar_card', $use);
}

function payroll_pan_card_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'payroll/pan_card', $use);
}

function payroll_voter_id_card_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'payroll/voter_id_card', $use);
}

function payroll_edu_qualification_marksheet_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'payroll/edu_qualification_marksheet',
        $use
    );
}

function payroll_post_graduation_marksheet_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'payroll/post_graduation_marksheet',
        $use
    );
}

function payroll_employee_signature_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'payroll/employee_signature',
        $use
    );
}

function payroll_other_document_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'payroll/other_document',
        $use
    );
}

function payroll_tenth_marksheet_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'payroll/tenth_marksheet',
        $use
    );
}

function payroll_twelveth_marksheet_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'payroll/twelveth_marksheet',
        $use
    );
}


/*
|--------------------------------------------------------------------------
| Website
|--------------------------------------------------------------------------
*/

function slider_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'website/slider', $use);
}

function popup_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'website/popup', $use);
}

function news_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'website/news', $use);
}

function media_gallery_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'website/media-gallery', $use);
}

function class_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'website/class-photo', $use);
}

function achievement_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'website/achievement', $use);
}

function gallery_dir($school_name, $use = 'external')
{
    return school_asset_dir($school_name, 'website/gallery', $use);
}

function assembly_activities_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/assembly_activities',
        $use
    );
}

function school_toppers_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/class_toppers',
        $use
    );
}

function sports_achiever_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/sports_achiever',
        $use
    );
}

function school_cabinet_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/school_cabinet',
        $use
    );
}

function former_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/former_details',
        $use
    );
}

function committee_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/committee_details',
        $use
    );
}

function public_discloser_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/public_discloser',
        $use
    );
}

function tc_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/tc',
        $use
    );
}

function alumni_achievers_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/alumni_achievers',
        $use
    );
}

function chief_guest_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/chief_guest',
        $use
    );
}

function management_message_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/management_message',
        $use
    );
}

function sports_achievers_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/sports_achievers',
        $use
    );
}

function blog_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/blogs',
        $use
    );
}

function audio_video_message_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/audio_video_message',
        $use
    );
}


/*
|--------------------------------------------------------------------------
| Calendar Planning
|--------------------------------------------------------------------------
*/

function circular_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'calender/circular',
        $use
    );
}


/*
|--------------------------------------------------------------------------
| Fee
|--------------------------------------------------------------------------
*/

function fee_concession_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'fee/fee_concession',
        $use
    );
}


/*
|--------------------------------------------------------------------------
| Front Office
|--------------------------------------------------------------------------
*/

function visitors_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'front_office/visitors_photo',
        $use
    );
}

function gate_pass_photo_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'front_office/gate_pass_photo',
        $use
    );
}

function pre_admission_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'front_office/pre_admission',
        $use
    );
}

function student_app_popup_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'front_office/popup',
        $use
    );
}


/*
|--------------------------------------------------------------------------
| Accounts
|--------------------------------------------------------------------------
*/

function account_voucher_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'account_voucher',
        $use
    );
}


/*
|--------------------------------------------------------------------------
| General Assets
|--------------------------------------------------------------------------
*/

function whatsapp_uploads_dir($use = 'external')
{
    return asset_dir('assets/whatsapp_uploads', $use);
}

function student_Reg_file_uploads_dir($use = 'external')
{
    return asset_dir('assets/students_website_reg_doc', $use);
}

function id_card_backgrounds($use = 'external')
{
    return asset_dir('assets/id_card_backgrounds', $use);
}

function cc_bc_tf_backgrounds($use = 'external')
{
    return asset_dir('assets/cc_bc_tf_backgrounds', $use);
}

function greeting_card_backgrounds($use = 'external')
{
    return asset_dir('assets/greeting_card_background', $use);
}


/*
|--------------------------------------------------------------------------
| Exam
|--------------------------------------------------------------------------
*/

function examdatesheet_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'Exam_date_sheet',
        $use
    );
}


/*
|--------------------------------------------------------------------------
| Ticket
|--------------------------------------------------------------------------
*/

function ticket_generate($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'ticket-generate',
        $use
    );
}


/*
|--------------------------------------------------------------------------
| Resume / Website Job
|--------------------------------------------------------------------------
*/

function resume_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/resume_photo',
        $use
    );
}


/*
|--------------------------------------------------------------------------
| Magazine
|--------------------------------------------------------------------------
*/

function magazine_cover_image_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/magazine/coverImage',
        $use
    );
}

function magazine_pdf_file_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/magazine/pdfFile',
        $use
    );
}

function website_fees_structure($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'website/feesStructure',
        $use
    );
}


/*
|--------------------------------------------------------------------------
| Question Paper
|--------------------------------------------------------------------------
*/

function previous_year_question_paper($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'questionPaper',
        $use
    );
}


/*
|--------------------------------------------------------------------------
| Achievement Certificate
|--------------------------------------------------------------------------
*/

function acheivement_certificate($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'acheivement/certificate',
        $use
    );
}


/*
|--------------------------------------------------------------------------
| Task Management
|--------------------------------------------------------------------------
*/

function task_management_dir($school_name, $use = 'external')
{
    return school_asset_dir(
        $school_name,
        'task_management',
        $use
    );
}


/*
|--------------------------------------------------------------------------
| File Helpers
|--------------------------------------------------------------------------
*/

function unlink_file($path)
{
    if (!empty($path) && file_exists($path) && is_file($path)) {
        unlink($path);
    }
}
