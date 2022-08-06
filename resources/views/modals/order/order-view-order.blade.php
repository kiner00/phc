<div wire:ignore.self class="modal fade" id="viewOrder" tabindex="-1" aria-labelledby="viewOrderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewOrderLabel">View Order Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="bg-light rounded h-100 p-4">
              <div class="col-12">
                  <div class="bg-light rounded h-100 p-4">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Infromation</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                  <th>Platform</th>
                                  <th>{{$viewPlatform}}</th>
                              </tr>
                              <tr>
                                  <th>Shipping Status</th>
                                  <th>{{$viewFulfillment}}</th>
                              </tr>
                              <tr>
                                  <th>Order Number</th>
                                  <th>{{$viewOrderNumber}}</th>
                              </tr>
                              <tr>
                                  <th>Full Name</th>
                                  <th>{{$viewFullName}}</th>
                              </tr>
                              <tr>
                                  <th>Mobile Number</th>
                                  <th>{{$viewMobileNumber}}</th>
                              </tr>
                              <tr>
                                  <th>Complete Address</th>
                                  <th>{{$viewCompleteAddress}}</th>
                              </tr>
                              <tr>
                                  <th>Processed By</th>
                                  <th>{{$viewProcessedBy}}</th>
                              </tr>
                              @foreach($viewProducts as $key => $viewProduct)
                                <tr>
                                    <th>Product {{$key+1}}</th>
                                    <th>{{$viewProduct->product->name}} <br />
                                      Price : {{$viewProduct->price}}<br />
                                      Quantity : {{$viewProduct->quantity}}<br />
                                      Total : Php{{$viewProduct->total}}
                                    </th>
                                </tr>
                              @endforeach
                              <tr>
                                <th>Grand Total</th>
                                <th>Php{{$viewGrandTotal}}</th>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                  </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>