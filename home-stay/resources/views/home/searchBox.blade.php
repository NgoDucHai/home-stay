<div class="form-wrap">
    <div class="tab">
        <div class="tab-content">
            <div class="tab-content-inner active" data-content="signup">
                <h3 class="cursive-font">Table Reservation</h3>
                <form action="/search" method="get" id="search">
                    <div class="scroll">
                        <div class="form-group">
                            <label for="city">Select State:</label>
                            <select name="city" class="form-control">
                                <option value="">--- Select City ---</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->code }}">{{ $city->prefix }} {{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Select District:</label>
                            <select name="district" class="form-control">
                                <option value="">--- Select District ---</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Select District:</label>
                            <select name="province" class="form-control">
                                <option value="">--- Select Province ---</option>
                            </select>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="activities">Persons</label>
                                <select name="capacity" id="activities" class="form-control">
                                    <option value="">Persons</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5+</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="start-date">Start Date</label>
                                <input type="text"  name="available_from" id="start-date" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="end-date">End Date</label>
                                <input type="text" name="available_to" id="end-date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary btn-block" value="Reserve Now">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
