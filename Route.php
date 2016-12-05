Route::get('branch', 'BranchController@index');
Route::get('getdistrictList', array('as' => 'post', 'uses' => 'BranchController@getdistrictList'));
Route::get('getupazilaList', array('as' => 'post', 'uses' => 'BranchController@getupazilaList'));