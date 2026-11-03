<?php



// WITHOUT RELATION FETCH


// public function fetch()
// {
//     return $this->commonFetch(
//         RoomType::class
//     );
// }


//  WITH RELATION FETCH

// public function fetch()
// {
//     return $this->commonFetch(
//         TransportAssignVehicle::class,
//         ['vehicle', 'route']
//     );
// }



// WITHOUT RELATION SHOW

// public function show(Request $request)
// {
//     return $this->commonShow(
//         RoomType::class,
//         $request
//     );
// }

// WITH RELATION SHOW

// public function show(Request $request)
// {
//     return $this->commonShow(
//         TransportAssignVehicle::class,
//         $request,
//         ['vehicle', 'route']
//     );
// }


//  DUPLICATE CHECK

// $duplicate = $this->isDuplicate(
//     RoomType::class,
//     [
//         'room_type' => $request->room_type
//     ],
//     $request->room_type_id
// );



// generic fetch method 

// $this->commonFetch(
//     Student::class,
//     [],
//     [
//         'class_id'   => $request->class_id,
//         'section_id' => $request->section_id,
//         'is_active'  => 1
//     ],
//     'roll_no',
//     'asc',
//     null,
//     null,
//     'collection'
// );




// sms template 


// <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('sms_templates', function (Blueprint $table) {

//             $table->id();

//             // Null = Global Template
//             $table->unsignedBigInteger('school_id')->nullable();

//             // Admin Friendly Name
//             $table->string('name');

//             // fee_received
//             // attendance_marked
//             $table->string('template_key');

//             // sms | whatsapp
//             $table->string('channel');

//             // en, hi
//             $table->string('language', 10)->default('en');

//             // MSG91, Twilio, Gupshup, Meta
//             $table->string('provider')->nullable();

//             // SMS Sender ID
//             $table->string('sender_id')->nullable();

//             // DLT Template ID / WhatsApp Template ID
//             $table->string('provider_template_id')->nullable();

//             // WhatsApp Template Name
//             $table->string('provider_template_name')->nullable();

//             // Template Content
//             $table->longText('content');

//             // ["student_name","amount","receipt_no"]
//             $table->json('variables')->nullable();

//             $table->text('description')->nullable();

//             $table->boolean('is_system')->default(false);

//             $table->boolean('is_active')->default(true);

//             $table->timestamps();

//             $table->softDeletes();

//             $table->unique([
//                 'school_id',
//                 'template_key',
//                 'channel',
//                 'language'
//             ]);

//             $table->index('school_id');
//             $table->index('template_key');
//             $table->index('channel');
//             $table->index('language');
//             $table->index('provider');
//             $table->index('is_active');

//             // Uncomment if schools table exists
//             // $table->foreign('school_id')
//             //     ->references('id')
//             //     ->on('schools')
//             //     ->nullOnDelete();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('sms_templates');
//     }
// };






//  {
//         "name": "Admission Approved",
//         "template_key": "admission_approved",
//         "language": "en",
//         "title": "Admission Approved",
//         "content": "Congratulations! Admission of :student_name has been approved for Class :class_name.",
//         "variables": [
//             "student_name",
//             "class_name"
//         ],
//         "description": "Triggered after admission approval.",
//         "is_system": true,
//         "is_active": true
//     },
//     {
//         "name": "Birthday Wishes",
//         "template_key": "birthday_wish",
//         "language": "en",
//         "title": "Happy Birthday!",
//         "content": "Happy Birthday :student_name! Wishing you happiness, success, and a wonderful year ahead.",
//         "variables": [
//             "student_name"
//         ],
//         "description": "Automatically sent on student's birthday.",
//         "is_system": true,
//         "is_active": true
//     }









//  icons 

// file           ->       <i class="ri-file-code-line text-2xl text-primary-600"></i>
// notification   ->       <i class="ri-notification-line text-lg text-primary-600"></i>
// trash          ->       <i class="ri-delete-bin-6-line text-lg"></i>
// edit           ->       <i class="ri-edit-line text-lg"></i>
// fill toggle    ->       <i class="ri-toggle-fill text-lg"></i>
// emp toggle    ->       <i class="ri-toggle-line text-lg"></i>