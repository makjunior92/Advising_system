<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
    
	Route::get('bids/bidding_window','BidController@bidding_window');

	Route::get('/','BidController@top_10_courses');

	Route::get('bids/course-autocomplete/{query?}', 'OffCourseController@offers_autocomplete');

	Route::post('bids/save_preference','BidController@save_preference_func');

	Route::get('bids/show_my_bids/{id}','BidController@show_my_bids_func');

	Route::get('bids/show_my_allocations/{id}','StudentController@show_my_allocations_func');

	Route::get('bids/save_preference_successful','BidController@save_preference_successful_func');

		


	Route::get('/home', 'HomeController@index');

});


Route::group(['middleware'=>['auth','admin']],function(){

	Route::get('bids/admin_bid_bellchart','BidController@admin_bid_bellchart');

	Route::get('bids/admin_bid_top_ten','BidController@admin_bid_top_ten');

	Route::get('allocations/market_clearing_prices','EnrollCourseController@market_clearing_prices');

	Route::resource('users','UserController');

	Route::resource('departments', 'DepartmentController');

	Route::resource('faculties', 'FacultyController');

	Route::resource('courses', 'CourseController');

	Route::resource('offeredcourses', 'OffCourseController' );

	Route::resource('students', 'StudentController');

	Route::resource('allocations', 'EnrollCourseController');
	

	Route::get('execute_algorithm','BidController@execute_algorithm');

	Route::get('bids/most_popular_courses','BidController@most_popular_courses_func');

	Route::get('bids/view_all_bids/{id}','BidController@view_all_bids_func');

	Route::resource('bids','BidController');
});





Auth::routes();

