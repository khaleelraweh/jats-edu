<div class="container">
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="search">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="certificate_id">رقم الشهادة</label>
                        <input type="text" name="certificate_id" id="certificate_id" class="form-control"
                            wire:model.defer="certificate_id">
                        @error('certificate_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Search</button>
            </form>
        </div>
    </div>

    @isset($certificate)
        <div class="card mt-3">
            <div class="card-body">
                <table class="responsive-table">
                    <tr>
                        <td>رقم الشهادة:</td>
                        <td>{{ $certificate->id }}</td>
                    </tr>
                    <tr>
                        <td>اسم المتدرب:</td>
                        <td>{{ $certificate->full_name }}</td>
                    </tr>
                    <tr>
                        <td>اسم الدورة التدريبية:</td>
                        <td>{{ $certificate->course->title }}</td>
                    </tr>
                    <tr>
                        <td>تاريخ الاصدار :</td>
                        <td>{{ $certificate->date_of_issue }}</td>
                    </tr>
                </table>
            </div>
        </div>
    @endisset
</div>
