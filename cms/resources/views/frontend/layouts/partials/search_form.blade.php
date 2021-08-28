<div class="filter-search">
    <div class="container nl-container"><a class="toggle-form" data-toggle="collapse" href="#collapseForm" aria-expanded="false">Filter</a>
        <div class="filter-form regular-form collapse" id="collapseForm">
            <form action="{{ route('search.index') }}">
                <input type="hidden" name="tenure[]" id="tenure-input" value="{{ !empty(request()->query('tenure')[0]) ? request()->query('tenure')[0] : null }}">
                <input type="hidden" name="district[]" id="district-input" value="{{ !empty(request()->query('district')[0]) ? request()->query('district')[0] : null }}">
                <input type="hidden" name="type[]" id="type-input" value="{{ !empty(request()->query('type')[0]) ? request()->query('type')[0] : null }}">
                <div class="position">
                    <input type="text" name="search" placeholder="Search by Property name. Address or Location" value="{{ !empty(request()->query('search')) ? request()->query('search') : null }}"><i class="fa fa-search"></i>
                </div>
                <div class="tenue">
                    <div class="nl-dropbox">
                        <div class="nl-select tenure-select">Tenure
                        </div>
                        <div class="nl-droplist">
                            <div class="droplist-container">
                                <div class="droplist-content scroll-ui">
                                    <div class="item-value tenure-option" data-search="" data-value="Tenure">Any</div>
                                    @if(isset($tenures) && count($tenures) > 0)
                                        @foreach($tenures as $tenure) 
                                        <div class="item-value tenure-option @if(!empty(request()->query('tenure')[0]) && $tenure->id == request()->query('tenure')[0]) choosing @endif" data-search="{{ $tenure->id }}" data-value="{{ $tenure->name }}">{{ $tenure->name }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="district">
                    <div class="nl-dropbox">
                        <div class="nl-select district-select">District
                        </div>
                        <div class="nl-droplist">
                            <div class="droplist-container">
                                <div class="droplist-content scroll-ui">
                                    <div class="item-value district-option" data-search="" data-value="District">Any</div>
                                    @if(isset($districts) && count($districts) > 0)
                                        @foreach($districts as $district) 
                                        <div class="item-value district-option @if(!empty(request()->query('district')[0]) && $district->id == request()->query('district')[0]) choosing @endif" data-search="{{ $district->id }}" data-value="{{ $district->name }}">{{ $district->name }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="type">
                    <div class="nl-dropbox">
                        <div class="nl-select type-select">Type
                        </div>
                        <div class="nl-droplist">
                            <div class="droplist-container">
                                <div class="droplist-content scroll-ui">
                                    <div class="item-value type-option" data-search="" data-value="Type">Any</div>
                                    @if(isset($types) && count($types) > 0)
                                        @foreach($types as $type) 
                                         <div class="item-value type-option @if(!empty(request()->query('type')[0]) && $type->id == request()->query('type')[0]) choosing @endif" data-search="{{ $type->id }}" data-value="{{ $type->name }}">{{ $type->name }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search">
                    <button class="btn-search" type="submit" name="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>