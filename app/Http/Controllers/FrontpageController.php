<?php

namespace App\Http\Controllers;

use App\Property;
use App\Slider;
use Illuminate\Http\Request;

class FrontpageController extends Controller {

	public function index() {
		$sliders = Slider::latest()->get();

		$special_properties = Property::latest()
			->whereHas('features', function ($query) {
				$query->where('features.slug', '=', 'special-listing');
			})
			->where('status', 1)
			->orderBy('created_at', 'DESC')
			->take(12)
			->get();

		$top_properties = Property::latest()
			->whereHas('features', function ($query) {
				$query->where('features.slug', '=', 'top-listing');
			})
			->where('status', 1)
			->orderBy('created_at', 'DESC')
			->take(12)
			->get();

		$featured_properties = Property::latest()
			->whereHas('features', function ($query) {
				$query->where('features.slug', '=', 'featured-listing');
			})
			->where('status', 1)
			->orderBy('created_at', 'DESC')
			->take(12)
			->get();

		$normal_properties = Property::latest()
			->whereHas('features', function ($query) {
				$query->where('features.slug', '=', 'normal-listing');
			})
			->where('status', 1)
			->orderBy('created_at', 'DESC')
			->get();

		return view('frontend.index',
			compact('sliders', 'special_properties', 'top_properties', 'featured_properties', 'normal_properties'));
	}

	public function search(Request $request) {
		$city = strtolower($request->city);
		$type = $request->type;
		$purpose = $request->purpose;
		$bedroom = $request->bedroom;
		$bathroom = $request->bathroom;
		$minprice = $request->minprice;
		$maxprice = $request->maxprice;
		$minarea = $request->minarea;
		$maxarea = $request->maxarea;
		$featured = $request->featured;

		$properties = Property::latest()->withCount('comments')
			->when($city, function ($query, $city) {
				return $query->where('city', '=', $city);
			})
			->when($type, function ($query, $type) {
				return $query->where('type', '=', $type);
			})
			->when($purpose, function ($query, $purpose) {
				return $query->where('purpose', '=', $purpose);
			})
			->when($bedroom, function ($query, $bedroom) {
				return $query->where('bedroom', '=', $bedroom);
			})
			->when($bathroom, function ($query, $bathroom) {
				return $query->where('bathroom', '=', $bathroom);
			})
			->when($minprice, function ($query, $minprice) {
				return $query->where('price', '>=', $minprice);
			})
			->when($maxprice, function ($query, $maxprice) {
				return $query->where('price', '<=', $maxprice);
			})
			->when($minarea, function ($query, $minarea) {
				return $query->where('area', '>=', $minarea);
			})
			->when($maxarea, function ($query, $maxarea) {
				return $query->where('area', '<=', $maxarea);
			})
			->when($featured, function ($query, $featured) {
				return $query->where('featured', '=', 1);
			})
			->where('status', 1)
			->paginate(10);

		return view('pages.search', compact('properties'));
	}

}
