<div class="modal fade" id="vehicleModal" data-id='' data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Manage Vehicle</h1>
                <button type="button" class="btn-close closeVehicleModalBtn" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="" method="POST" id="vehicle-form">
                    @csrf
                        <input type="hidden" class='form-control vehicleInput' name="id" id="vehicle-id" >
                        <div class="row">
                            <div class="col">
                            <label for="accounts-lastName">Vehicle Type</label>
                                <select class="form-select" id="vehicle-type" name="vehicleType" required>
                                     <option value="" selected disabled hidden>Select</option>
                                    <option value="car">Car</option>
                                    <option value="motor">Motor</option>
                                    <option value="owner type">Owner Type</option>
                                    <option value="van">Owner Type</option>
                                    <option value="pickup truck">Pickup Truck</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <label for="accounts-lastName">Make</label>
                                <input type="text" class='form-control vehicleInput' name="make" id="vehicle-make" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                            <label for="accounts-lastName">Model</label>
                                <input type="text" class='form-control vehicleInput' name="model" id="vehicle-model" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <label for="accounts-lastName">Variant</label>
                                <input type="text" class='form-control vehicleInput' name="variant" id="vehicle-variant" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <label for="accounts-lastName">Plate No.</label>
                                <input type="text" class='form-control vehicleInput' name="plateNo" id="vehicle-plateNo" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <label for="accounts-lastName">Year</label>
                                <input type="text" class='form-control vehicleInput' name="year" id="vehicle-year" required>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" form="vehicle-form" value="Save">
                <!-- <button type="button" class="btn btn-primary" id="submitAccountBtn" disabled>Save</button> -->
                <button type="button" class="btn btn-secondary closeVehicleModalBtn">Close</button>
            </div>
        </div>
    </div>
</div>