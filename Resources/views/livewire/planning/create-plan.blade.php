<div class="col-lg-12 col-md-6 col-sm-12">
    <div class="card card-outline">
        <div class="card-header">
            <h3 class="card-title text-bold">Please Select Financial Year and Appraiser</h3>
        </div>
        <div class="card-body">

            <form wire:submit.prevent="save">
                <div class="text-center">
                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Financial Year
                        </label>
                        <div class="col-sm-6">
                            <select  wire:model.lazy="financialYear" class="form-control">
                                @foreach($financialYears as $financialYear)
                                <option value="{{$financialYear->id}}">{{$financialYear->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="text-lg-right col-sm-3 col-form-label col-form-label-sm ">
                            Who will Appraise You?
                        </label>
                        <div class="col-sm-6">
                            <select  wire:model.lazy="appraiser" class="form-control">
                                @foreach($staffMembers as $staff)
                                    <option value="{{$staff->id}}">{{$staff->fullname()}}</option>
                                @endforeach
                            </select>
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
