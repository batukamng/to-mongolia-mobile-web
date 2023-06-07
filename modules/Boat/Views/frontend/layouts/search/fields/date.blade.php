<div class="form-group">
    <div class="form-content">
        <div class="form-date-search is_single_picker">
            <div class="date-wrapper">
                <div class="check-in-wrapper">
                    <label>From-To</label>
                    <!-- <div><i class="field-icon icofont-wall-clock"></i></div> -->
                    <div class="render check-in-render" ><i class="icofont-wall-clock"></i>{{Request::query('start',display_date(strtotime("today")))}}</div>
                </div>
            </div>
            <input type="hidden" class="check-in-input" value="{{Request::query('start',display_date(strtotime("today")))}}" name="start">
            <input type="text" class="check-in-out" name="date" value="{{Request::query('date',date("Y-m-d"))}}">
        </div>
    </div>
</div>