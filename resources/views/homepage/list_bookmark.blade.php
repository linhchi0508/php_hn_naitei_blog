@extends('homepage.app')

@section('content')

<section>
	<div class="gap2 gray-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="row merged20" id="page-contents">
						<div class="col-lg-12">
							<div class="central-meta">
								<div class="title-block">
									<div class="row">
										<div class="col-lg-6">
											<div class="align-left">
												<h5>{{ trans('homepage.Bookmarked') }} <span>{{ count($bookmark) }}</span></h5>
											</div>
										</div>
									</div>
								</div>
							</div><!-- title block -->

							<div class="row merged20">
								@foreach ($bookmark as $bm)
									<div class="col-lg-6 col-md-6">
										<div class="central-meta">
											<div class="blog-post">
												<div class="friend-info">
													<figure>
														@if (count(Auth::user()->images) != config('number.zero'))
	                    									<img class="user-image" src="{{ asset(Auth::user()->images[0]->image_url) }}" alt="">
	                    								@else
	                    									<img class="user-image" src="{{ asset('storage/image/default_user.jpg') }}" alt="">
	                    								@endif
													</figure>
													<div class="friend-name">
														<ins><a title="" href="time-line.html">{{ $bm->story->user->username }}</a></ins>
														<span><i class="fa fa-globe"></i> {{ $bm->story->status }}: {{ $bm->story->created_at }} </span>
														<span>{{ trans('homepage.category') }} : {{ $bm->story->category->name }}</span>
													</div>
													<div class="post-meta">
														@if (count($bm->story->images) > config('number.zero'))
									                        @if (count($bm->story->images) == config('number.one'))
										                        <figure class="mb-5">
										                            <img class="image-single" src="{{ asset( $bm->story->images[0]->image_url ) }}">
										                        </figure>
									                        @endif
									                        @if (count($bm->story->images) > config('number.one'))
										                        <figure>
										                            <div id="demo"  class="carousel slide row"  data-ride="carousel"> 
										                                <div class="carousel-inner col-12" >
										                                    <div class="carousel-item active">
										                                        <img src="{{ asset( $bm->story->images[0]->image_url ) }}" >
										                                    </div>
										                                    {{ $k = config('number.one') }}
										                                    @while ($k < count($bm->story->images))
										                                    <div class="carousel-item ">
										                                        <img src="{{ asset( $bm->story->images[$k]->image_url ) }}" >
										                                    </div>
										                                    {{ $k++ }}
										                                    @endwhile
										                                </div>
										                                <a class="carousel-control-prev" href="#demo" data-slide="prev">
										                                    <span class="carousel-control-prev-icon"></span>
										                                </a>
										                                <a class="carousel-control-next" href="#demo" data-slide="next">
										                                    <span class="carousel-control-next-icon"></span>
										                                </a>
										                            </div>
										                        </figure>
									                        @endif
								                        @endif		
														<div class="description">
															<a data-ripple="" class="learnmore" href="{{ route('stories.show', $bm->story->id) }}">{{ trans('homepage.Detail') }}</a>
															<p>
																{{ $bm->story->content }}
															</p>
														</div>
														<div class="we-video-info">
															<ul>
																<li>
																	<span title="Comments" data-toggle="tooltip" class="comment">
																		<i class="ti-comments"></i>
																		<ins>{{ $bm->story->total_comment }}</ins>
																	</span>
																</li>
																<li>
																	<span title="like" data-toggle="tooltip" class="like">
																		<i class="fa fa-thumbs-o-up"></i>
																		<ins>{{ $bm->story->total_like }}</ins>
																	</span>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div><!-- centerl meta -->
					</div>	
				</div>
			</div>
		</div>
	</div>	
</section>

@endsection
