<div class="col-lg-12 col-md-6 col-sm-12">
    <div class="card card-outline">
        <div class="card-header">
            <h3 class="card-title text-bold">Please select financial year and appraiser</h3>
        </div>
        <div class="card-body">

            <form wire:submit.prevent="save">
                <div class="text-center">
                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Financial Year
                        </label>
                        <div class="col-sm-6">
                            <select  wire:model.lazy="selectedYear" class="form-control">
                                @foreach($financialYears as $financialYear)
                                <option value="{{$financialYear->id}}">{{strtoupper($financialYear->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Who will Appraise You?
                        </label>
                        <div class="col-sm-6">
                            <div style="position:relative">
                                <input wire:model.debounce.200ms="searchAppraiser" class="form-control" type="text" placeholder="Search..."/>
                            </div>
                            @if($showDropdown)
                            <div class="">
                                @if(strlen($searchAppraiser)>2)
                                    @if(count($staffMembers)>0)
                                        <ul class="list-group">
                                            @foreach($staffMembers as $appraiser)
                                                <li class="list-group-item list-group-item-action">
                                                    <a href="#" wire:click="selectAppraiser('{{$appraiser->id}}')">
                                                        {{$appraiser->fullname()}} ({{$appraiser->employment->getPosition()}})
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <li class="list-group-item">Record not found...</li>
                                    @endif
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle"></i> Create
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
