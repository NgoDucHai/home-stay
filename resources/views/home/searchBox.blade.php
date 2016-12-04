<div class="form-wrap">
    <div class="tab">
        <div class="tab-content">
            <div class="tab-content-inner active" data-content="signup">
                <h3 class="cursive-font">
                    Search for home stay</h3>
                <form action="/search" method="get" id="search">
                    <div class="scroll">
                        <div class="form-group">
                            <label for="city">Tỉnh/Thành phố</label>
                            <select name="city" class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Quận/Huyện</label>
                            <select name="district" class="form-control" required>
                                <option value="" class="tinos-font">--- Chọn Quận/Huyện ---</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Xã/Phường</label>
                            <select name="province" class="form-control" required>
                                <option value="">--- Chọn Xã/Phường ---</option>
                            </select>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="activities">Chọn số người</label>
                                <select name="capacity" id="activities" class="form-control" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5+</option>
                                    <option value="10">10+</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="start-date">Ngày bắt đầu</label>
                                <input type="text"  name="available_from" id="start-date" class="form-control" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="end-date">Ngày kết thúc</label>
                                <input type="text" name="available_to" id="end-date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary btn-block" value="Tìm kiếm ngay">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
