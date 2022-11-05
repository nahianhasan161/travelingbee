<template>
    <div class="wrap">
        <div class="loader" v-if="loading"></div>
         <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fab fa-forumbee"></i> Traveling Bee
                    <small class="float-right">Date: {{bookings.date}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>{{bookings.name}}</strong><br>
                    <!-- 795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br> -->
                    Email: {{bookings.User.email}} 
                  </address>
                </div>
                <!-- /.col -->
               <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{bookings.User.name}}</strong><br>
                   <!--  795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br> -->
                   <!--  Phone: (555) 539-1037<br> -->
                    Email: {{bookings.User.email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>BookingID: {{bookings.booking_id}}</b><br>
                  <br>
                
                  <b>Status:</b> <p class="text-success text-bold" v-if="bookings.status == 1"> Paid </p>
                  <p class="text-danger text-bold" v-else> Not Paid </p>
                  
                  <br>
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Due:</b> 2/22/2014<br>
                  <b>Account:</b> 968-34567
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Serial #</th>
                      
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>1</td>
                      <td>{{bookings.name}}</td>
                      <td>455-981-221</td>
                     
                      <td>৳{{bookings.price}}</td>
                    </tr>
                  
                  
                   
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                 <!--  <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> -->

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due 2/22/2014</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>৳{{bookings.price}}</td>
                      </tr>
                      <tr>
                        <th>Tax/Vat </th>
                        <td>৳0</td>
                      </tr>
                      <tr>
                        <th>Cupon:</th>
                        <td>0</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>৳{{bookings.price}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                    <!-- href="invoice-print.html" -->
                  <a  onclick="window.print()" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                 
                 
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    </div>
 
</template>
  <script setup>
        import axios from 'axios';
import { storeToRefs } from 'pinia';
        import {onMounted ,ref,reactive} from 'vue';
        import {useRouter} from 'vue-router'
        import {CategoryStore} from '@/store/CategoryStore';
        
       import { useToastr } from '@/pages/toaster';
        const toastr = useToastr();
        const store = new CategoryStore();
        const router = new useRouter();
        
        const {categories,loading,err} = storeToRefs(CategoryStore());
        let Categories = ref(store.getCategories);
        const editing = ref(false);
        let editId = ref('')
        let form = reactive({
                name:'',

            });

            let currentPlaceID = ref('');
            let bookings = ref([])
            
           
       
           /*  const register = async()=>{

                await axios.post('/api/register',form).then(res=>{
                   if(res.data.success){


                    store.fetchAllUser();

                    toastr.success('success')

                    $('#ModalCenter').modal('hide');
                    this.resetForm()

                    }else{
                        errors.value = res.data[0].data

                    }
                }).catch(e=>{
                    toastr.error(e.response.data)
                    errors.value = e.response.data
                })

                console.log('finally');
            } */
            /* function updateUser(){
                axios.put('/api/user/'+editId,form).then(res=>{
                    store.fetchAllUser();
                    toastr.info('success')
                    $('#ModalCenter').modal('hide');
                }).finally(()=>{
                    this.resetForm()


                })
            } */

            async function bookingapi(){
        await axios.get('/api/booking/'+currentPlaceID+'/edit').then(res=>{
            if(res.data.success){
                bookings.value = res.data.data

                console.log(bookings.value)
                console.log(res.data.data)
            }
        })
        }

            async function setID(){
            currentPlaceID = router.currentRoute.value? router.currentRoute.value.params.id : '';
            }

            onMounted(async ()=>{
                await setID()
            await bookingapi()


        });

    </script>