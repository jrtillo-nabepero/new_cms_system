<x-admin-master>

    @section('content')

        <h1>All Posts</h1>

        @if(Session::has('message'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{Session::get('message')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        @elseif(Session::has('edit_message'))

        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          {{Session::get('edit_message')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Owner</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <!-- <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                    </tr>
                  </tfoot> -->
                  <tbody>
                    @foreach($posts as $post)
                    <tr>
                      <td>{{$post->id}}</td>
                      <td>{{$post->user->name}}</td>
                      <td><a href="{{route('post.edit', $post->id)}}">{{$post->title}}</a></td>
                      <td><img src="{{$post->post_image}}" alt="" width="200px" height="100px"></td>
                      <td>{{$post->created_at->diffForHumans()}}</td>
                      <td>{{$post->updated_at->diffForHumans()}}</td>
                      <td>

                      @can('view', $post)
                        <form method="post" action="{{route('post.destroy',$post->id)}}" enctype="multipart/form-data">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                      @endcan
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center">
            {{$posts->links('pagination::bootstrap-4')}}
          </div>
    @endsection
</x-admin-master>