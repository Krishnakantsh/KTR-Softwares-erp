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

