<?php

namespace App\Models\Student;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\House;
use App\Models\ClassMaster;
use App\Models\ClassSection;
use App\Models\LibraryMembership;
use App\Models\ManageStudentHostel;
use App\Models\ManageStudentTransport;
use App\Models\StreamMaster;
use App\Models\Student\StudentParent;
use App\Models\Student\StudentDocument;
use App\Models\Student\StudentBankDetail;


class Student extends BaseModel
{
      use SoftDeletes;

      protected $guarded = [];

      protected $casts = [
            'is_active' => 'boolean',
            'is_ews' => 'boolean',
            'is_study_material' => 'boolean',
            'is_physically_challenged' => 'boolean',
            'is_Transport_apply' => 'boolean',
            'is_Hostel_apply' => 'boolean',
            'admission_date' => 'date',
            'dob' => 'date',
      ];

      public function classMaster()
      {
            return $this->belongsTo(
                  ClassMaster::class,
                  'class_id'
            );
      }

      public function section()
      {
            return $this->belongsTo(
                  ClassSection::class,
                  'section_id'
            );
      }

      public function stream()
      {
            return $this->belongsTo(
                  StreamMaster::class,
                  'stream_id'
            );
      }

      public function house()
      {
            return $this->belongsTo(
                  House::class,
                  'house_id'
            );
      }

      public function education()
      {
            return $this->hasMany(
                  StudentEducationDetail::class,
                  'student_id'
            );
      }

      public function transport()
      {
            return $this->hasOne(
                  ManageStudentTransport::class,
                  'student_id'
            );
      }
      public function hostel()
      {
            return $this->hasOne(
                  ManageStudentHostel::class,
                  'student_id'
            );
      }

      public function bankDetail()
      {
            return $this->hasOne(
                  StudentBankDetail::class,
                  'student_id'
            );
      }

      public function personalDetail()
      {
            return $this->hasOne(
                  StudentPersonalDetail::class,
                  'student_id',
                  'id'
            );
      }

      public function contactDetail()
      {
            return $this->hasOne(
                  StudentContactDetail::class,
                  'student_id'
            );
      }

      public function previousDetail()
      {
            return $this->hasOne(
                  StudentPreviousDetail::class,
                  'student_id',
                  'id'
            );
      }

      public function documents()
      {
            return $this->hasMany(
                  StudentDocument::class,
                  'student_id',
                  'id'
            );
      }


      public function educationDetails()
      {
            return $this->hasMany(
                  StudentEducationDetail::class,
                  'student_id',
                  'id'
            );
      }

      public function objections()
      {
            return $this->hasMany(
                  StudentObjection::class,
                  'student_id',
                  'id'
            );
      }


      public function getFullNameAttribute()
      {
            return trim(
                  $this->first_name . ' ' . $this->last_name
            );
      }

      public function parents()
      {
            return $this->hasMany(
                  StudentParent::class,
                  'student_id',
                  'id'
            );
      }


      public function father()
      {
            return $this->hasOne(StudentParent::class)
                  ->where('parent_type', 'father');
      }

      public function mother()
      {
            return $this->hasOne(StudentParent::class)
                  ->where('parent_type', 'mother');
      }

      public function guardian()
      {
            return $this->hasOne(StudentParent::class)
                  ->where('parent_type', 'guardian');
      }


      public function libraryMembership()
      {
            return $this->hasOne(LibraryMembership::class, 'student_id');
      }
}
