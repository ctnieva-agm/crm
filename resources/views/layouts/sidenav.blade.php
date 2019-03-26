<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column" id="src-list">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" disabled>
                            <span class="fa fa-book"></span>
                            Source List <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    @foreach( \App\Contact::get('source')->unique('source')->sortBy('source')->pluck('source') as $src)
                    <li class="nav-item {{ $source != '<none>' && $source == $src ? 'bg-info' : '' }}">
                        <a class="nav-link source {{ $source != '<none>' && $source == $src ? 'text-light' : '' }}" href="{{ route('home.source') . "?q=" . ( $src == '' ? '(Undefined)' : $src) }}" source-name="{{ $src == '' ? '(Undefined)' : $src}}">
                            {{ $src == '' ? '(Undefined)' : $src}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </nav>
        {{ $content }}
    </div>
</div>
{{ $modals }}
