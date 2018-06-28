@section('blogs-post-list-content')
<div class="row">
  <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
    <h4>{!! trans('admin.posts_list') !!}</h4>
  </div>
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <div class="pull-right">
      <a href="{{ route('admin.add_blog') }}" class="btn btn-primary">{!! trans('admin.add_new_post') !!}</a>
    </div>  
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <div id="table_search_option">
          <form action="{{ route('admin.all_blogs') }}" method="GET"> 
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="input-group">
                  <input type="text" name="term_blog" class="search-query form-control" placeholder="{{ trans('admin.post_title_search_placeholder') }}" value="{{ $search_value }}" />
                  <div class="input-group-btn">
                    <button class="btn btn-primary" type="submit">
                      <span class="glyphicon glyphicon-search"></span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>  
        </div>      
        <table id="table_for_manufacturers_list" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>{!! trans('admin.image') !!}</th>
              <th>{!! trans('admin.post_title') !!}</th>
              <th>{!! trans('admin.status') !!}</th>
              <th>{!! trans('admin.action') !!}</th>
            </tr>
          </thead>
          <tbody>
            @if(count($blogs_list_data)>0)
              @foreach($blogs_list_data as $row)
                <tr>
                  @if(!empty($row['featured_image']))
                    <td><img src="{{ $row['featured_image'] }}" alt="{{ basename ($row['featured_image']) }}"></td>
                  @else
                    <td><img src="{{ asset('resources/assets/images/no-image.png') }}" alt=""></td>
                  @endif

                  <td>{!! $row['post_title'] !!}</td>

                  @if($row['post_status'] == 1)
                    <td>{!! trans('admin.enable') !!}</td>
                  @else
                    <td>{!! trans('admin.disable') !!}</td>
                  @endif

                  <td>
                    <div class="btn-group">
                      <button class="btn btn-success btn-flat" type="button">{!! trans('admin.action') !!}</button>
                      <button data-toggle="dropdown" class="btn btn-success btn-flat dropdown-toggle" type="button">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul role="menu" class="dropdown-menu">
                        <li><a target="_blank" href="{{ route('blog-single-page', $row['post_slug']) }}"><i class="fa fa-eye"></i>{!! trans('admin.view') !!}</a></li>  
                        @if(in_array('add_edit_blog', $user_permission_list))
                          <li><a href="{{ route('admin.update_blog', $row['post_slug']) }}"><i class="fa fa-edit"></i>{!! trans('admin.edit') !!}</a></li>
                        @endif
                        
                        @if(in_array('delete_blog', $user_permission_list))
                          <li><a class="remove-selected-data-from-list" data-track_name="blog_list" data-id="{{ $row['id'] }}" href="#"><i class="fa fa-remove"></i>{!! trans('admin.delete') !!}</a></li>
                        @endif
                      </ul>
                    </div>
                  </td>
                </tr>
              @endforeach
            @else
            <tr><td colspan="4"><i class="fa fa-exclamation-triangle"></i> {!! trans('admin.no_data_found_label') !!}</td></tr>
            @endif
          </tbody>
          <tfoot>
              <th>{!! trans('admin.image') !!}</th>
              <th>{!! trans('admin.post_title') !!}</th>
              <th>{!! trans('admin.status') !!}</th>
              <th>{!! trans('admin.action') !!}</th>
          </tfoot>
        </table>
          
        <div class="products-pagination">{!! $blogs_list_data->appends(Request::capture()->except('page'))->render() !!}</div>  
      </div>
    </div>
  </div>
</div>
@endsection