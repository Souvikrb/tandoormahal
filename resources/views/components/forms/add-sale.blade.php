<div class="card-body">
    <div class="form-group">
    <label>Menu</label>
    <input type="text" class="form-control" placeholder="Menu" required  name="menu" id="menu" >
    </div>
    <div class="form-group">
    <label>Quantity</label>
    <input type="text" class="form-control number" placeholder="Quantity" required name="quantity" id="quantity">
    </div>
    <div class="form-group">
    <label>Discount</label>
    <input type="text" class="form-control number" placeholder="Discount"  name="discount" id="discount">
    </div>
    <div class="form-group">
    <label>Price</label>
    <input type="text" class="form-control number" placeholder="Price" required name="price" id="price">
    </div>
    <div class="form-group">
    <label>Review</label>
    <textarea class="form-control"  name="review" placeholder="Enter Review" id="review"></textarea>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Date</label>
    <div class="input-group date" id="reservationdate" data-target-input="nearest">
        <input type="text" required name="date" value="{{date('d-m-Y')}}" class="form-control datetimepicker-input" placeholder="DD-MM-YYYY" data-target="#reservationdate" id="date" />
        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
        </div>
    </div>
    </div>
</div>