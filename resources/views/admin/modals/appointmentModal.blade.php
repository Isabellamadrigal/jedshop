<div class="modal fade" id="appointmentModal" data-id='' data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div id="modal-size" class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Manage</h1>
                <button type="button" class="btn-close closeAppointmentModalBtn" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="" method="POST" id="appointment-form">
                    @csrf
                        <input id="formType-appointment" value="" name="status" type="hidden">
                        <div class="inputfields-form">
                            
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