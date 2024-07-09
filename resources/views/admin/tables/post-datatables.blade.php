<x-admin-master>

    @section('content')

        <h1>All Posts</h1>
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
                      <th>Title</th>
                      <th>Image</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($posts as $post)
                    <tr>
                      <td>{{$post->user_id}}</td>
                      <td>{{$post->title}}</td>
                      <td><img src="{{$post->post_image}}" alt="" width="200px" height="100px"></td>
                      <td>{{$post->created_at->diffForHumans()}}</td>
                      <td>{{$post->updated_at->diffForHumans()}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    @endsection
</x-admin-master>