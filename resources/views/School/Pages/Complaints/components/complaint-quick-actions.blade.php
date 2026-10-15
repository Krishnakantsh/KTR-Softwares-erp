 <div class="card h-100">
     <div
         class="d-flex align-items-center flex-wrap gap-2 justify-content-between py-12 px-20 border-bottom border-neutral-200">
         <h6 class="mb-2 fw-bold text-lg">Quick Actions</h6>

     </div>
     <div class="card-body">

         <div class="row g-3">
             <div class="col-sm-12">
                 <div class="border rounded-3 p-12">

                     <div class="d-flex">

                         <button type="button" data-bs-toggle="modal" data-bs-target="#complaintTypeListModal"
                             class="btn btn-warning-100 d-flex align-items-center gap-6 px-16 text-warning-600 flex-grow-1 justify-content-center">
                             <i class="ri-price-tag-3-line me-1"></i>
                             Complaint Types
                         </button>
                     </div>
                 </div>
             </div>
             <div class="col-sm-12">
                 <div class="border rounded-3 p-12">

                     <div class="d-flex">

                         <button type="button" data-bs-toggle="modal" data-bs-target="#complaintTypeModal"
                             class="btn btn-primary-600 d-flex align-items-center gap-6 px-16 flex-grow-1 justify-content-center">
                             <i class="ri-add-circle-line me-1"></i>
                             Add Complaint Type
                         </button>

                     </div>
                 </div>
             </div>




             <div class="col-sm-6">
                 <div class="border rounded-3 p-12">

                     <div class="d-flex">

                         <a href="{{ route('school.complaint.index', ['type' => 'staff']) }}"
                             class="btn btn-warning-100 d-flex align-items-center gap-6 px-16 text-warning-600 flex-grow-1 justify-content-center">

                             Staff Complaint
                         </a>
                     </div>
                 </div>
             </div>
             <div class="col-sm-6">
                 <div class="border rounded-3 p-12">

                     <div class="d-flex">

                         <a href="{{ route('school.complaint.index', ['type' => 'student']) }}"
                             class="btn btn-warning-100 d-flex align-items-center gap-6 px-16 text-warning-600 flex-grow-1 justify-content-center">

                             Stu. Complaint
                         </a>
                     </div>
                 </div>
             </div>
             <div class="col-sm-12">
                 <div class="border rounded-3 p-12">

                     <div class="d-flex">
                         <button type="button" data-bs-toggle="modal" data-bs-target="#staffComplaintModal"
                             class="btn btn-primary-600 d-flex align-items-center gap-6 px-16 flex-grow-1 justify-content-center">
                             <i class="ri-add-circle-line me-1"></i>
                             Raise Staff Complaint
                         </button>

                     </div>
                 </div>
             </div>


             <div class="col-sm-12">
                 <div class="border rounded-3 p-12">

                     <div class="d-flex">

                         <button type="button" data-bs-toggle="modal" data-bs-target="#studentComplaintModal"
                             class="btn btn-warning-100 d-flex align-items-center gap-6 px-16 text-warning-600 flex-grow-1 justify-content-center">
                             <i class="ri-add-circle-line me-1"></i>
                             Raise Student Complaint
                         </button>
                     </div>
                 </div>
             </div>
         </div>

     </div>
 </div>
