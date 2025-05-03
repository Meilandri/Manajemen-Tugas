
  <!-- Modal Delete -->
  <div class="modal fade" id="modalTugasDestroy{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLongTitle">Hapus {{$title}} ? </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body text-left">
          <div class="row">
            <div class="col-6">
              Nama
            </div>
            <div class="col-6">
              : {{ $item->user->nama }}
            </div>
          </div>
  
          <div class="row">
              <div class="col-6">
                Email
              </div>
              <div class="col-6">
                :
                  <span class="badge badge-info">
                      {{ $item->user->email }}
                  </span>
              </div>
          </div>
  
            <div class="row">
              <div class="col-6">
                Jabatan
              </div>
              <div class="col-6">
                  :
                  @if ($item->jabatan == 'Admin')
                      <span class="badge badge-primary">
                          {{ $item->user->jabatan }}
                      </span>
                  @else
                  <span class="badge badge-warning">
                      {{ $item->user->jabatan }}
                  </span>
                  @endif
                            
              </div>
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
            <i class="fas fa-times"></i>
            Tutup
        </button>
        <form action="{{route('tugasDestroy', $item->id) }}" method="post">
            @csrf
            @method('delete')
          <button type="submit" class="btn btn-danger btn-sm">
            <i class="fas fa-trash"></i>
            Hapus
        </button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Show -->
  <div class="modal fade" id="modalTugasShow{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title" id="exampleModalLongTitle">Detail {{$title}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body text-left">

        <div class="row">
          <div class="col-6">
            Nama
          </div>
          <div class="col-6">
            : {{ $item->user->nama }}
          </div>
        </div>

        <div class="row">
            <div class="col-6">
              Email
            </div>
            <div class="col-6">
              :
                <span class="badge badge-info">
                    {{ $item->user->email }}
                </span>
            </div>
        </div>

          <div class="row">
            <div class="col-6">
              Jabatan
            </div>
            <div class="col-6">
                :
                @if ($item->jabatan == 'Admin')
                    <span class="badge badge-primary">
                        {{ $item->user->jabatan }}
                    </span>
                @else
                <span class="badge badge-warning">
                    {{ $item->user->jabatan }}
                </span>
                @endif
                          
            </div>
          </div>
      </div>
    </div>
  </div>