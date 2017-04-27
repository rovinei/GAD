<div class="hide-main-m">
	<h1 class="title_cat">Categories</h1>
	@foreach($categories as $category)
	<ul class="category-sidepbar">
		<li> <a class="m_link" href="{{url('menu/'.$menu->id.'/categories/'.$category->id.'/projects')}}">{{$category->translation(Lang::locale())->first() ? $category->translation(Lang::locale())->first()->title: $category->title}}</a>
			@foreach($category->categories()->orderBy('ordering')->get() as $subCategory)
			<ul class="sub-category-sidebar">
				<li> <a class="m_link" href="{{url('menu/'.$menu->id.'/categories/'.$subCategory->id.'/projects')}}">{{$subCategory->translation(Lang::locale())->first() ? $subCategory->translation(Lang::locale())->first()->title: $subCategory->title}} <strong>({{$subCategory->contents->count()}})</strong></a></li>
			</ul>
			@endforeach
		</li>
	</ul>
	@endforeach
</div>