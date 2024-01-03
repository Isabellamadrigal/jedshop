<div class="modal fade" id="appointmentModal" data-id='' data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Manage Appointment</h1>
                <button type="button" class="btn-close closeAppointmentModalBtn" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="" method="POST" id="appointment-form">
                    @csrf
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Vehicle</label>
                                        <select class="form-select" id="vehicle-list" name="vehicleId" required>
                                 
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Issue</label>
                                        <textarea class="form-control" rows="3" name="issue" placeholder="" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Prefered Date</label>
                                        <textarea class="form-control" rows="3" name="requestDate" placeholder="" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <label for="">Service Select</label>
                                        <table id="table" class="table">
                                            <thead>
                                                <Tr>
                                                    <th>Services</th>
                                                    <th>Action</th>
                                                </Tr>
                                            </thead>
                                            <tbody id="selectServiceTbody">
                                                <tr>
                                                    <td>
                                                     <select class="form-control" name="serviceId[]" id="service-service0" >
                                                       
                                                    </select>
                                                    </td>
                                                    <td>
                                                     <button type="button" class="btn btn-primary btn-sm addServices" data-id='0'>Add</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                       
                                    </div>
                                </div>

                            </div>
                        </div>

                    </form>
                    
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" form="appointment-form" value="Save">
                <!-- <button type="button" class="btn btn-primary" id="submitAccountBtn" disabled>Save</button> -->
                <button type="button" class="btn btn-secondary closeAppointmentModalBtn">Close</button>
            </div>
        </div>
    </div>
</div>