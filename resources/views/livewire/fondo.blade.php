<div>
    {{-- In work, do what you enjoy. --}}
    <a wire:click="cambiofondo({{ Auth::user()->id }},'{{ Request::url() }}')" class="nav-link"  role="button" >
        @if(Auth::user()->darkmode)
        {{-- <i class="fas fa-toggle-on"></i>  --}}
        <i class="fas fa-adjust"></i>
        @else
        {{-- <i class="fas fa-toggle-off"></i> --}}
        <i class="far fa-moon"></i>
        @endif
      </a>
      
</div>
