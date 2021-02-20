<template>
    <div>

        <div class="search_form">
            <input type="text" v-model="search_text" class="form-control" placeholder="نام محصول ...">
            <button class="btn btn-primary" v-on:click="getProductList(1)">جست و جو</button>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>تصویر</th>
                <th>عنوان</th>
                <th>رنگ</th>
                <th>عملیات</th>

            </tr>
            </thead>

            <tbody>
            <tr v-for="(item,key) in ProductList.data">
                <td>{{ getRow(key) }}</td>
                <td>
                    <img v-bind:src="$siteUrl+'storage/'+item.product.image.path" class="product_pic"/>
                </td>
                <td>{{item.product.title}}</td>
                <td>{{item.color.name}}</td>
                <td>
                    <p class="select_item" v-on:click="show_box(item.id,key)">انتخاب</p>
                    <p class="remove_item" v-if="item.offers == 1" v-on:click="remove_offers(item.id,key)">حذف</p>
                </td>
            </tr>
            </tbody>
        </table>
        <pagination-component :data="ProductList"@pagination-change-page="getProductList"></pagination-component>

        <div class="message_div" style="display:block" v-if="show_message_box">
            <div class="message_box">
                <p id="msg">آیا از حذف این محصول از لیست پیشنهاد شگفت انگیز مطمین هستین ؟‌</p>
                <a class="alert alert-success" v-on:click="remove_of_list()">بله</a>
                <a class="alert alert-danger" v-on:click="show_message_box=!show_message_box">خیر</a>
            </div>

        </div>

        <div class="modal" id="priceBpx" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>افزودن به لیست پیشنهادات شگفت انگیز</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">

                        <div v-if="server_errors" class="alert alert-warning">
                            <ul class="list-inline">
                                <li v-for="error in server_errors">
                                    {{ error[0] }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label>هزینه محصول : </label>
                            <cleave :options="options" v-model="formInput.price1" class="form-control left" ></cleave>
                            <span class="has_error" v-if="errors.price1_error">{{ errors.price1_error }}</span>
                        </div>

                        <div class="form-group">
                            <label>هزینه محصول برای فروش : </label>
                            <cleave :options="options" v-model="formInput.price" class="form-control left" ></cleave>
                            <span class="has_error" v-if="errors.price_error">{{ errors.price_error }}</span>
                        </div>

                        <div class="form-group">
                            <label>تعداد موجودی محصول : </label>
                            <cleave :options="options" v-model="formInput.product_number" class="form-control left" ></cleave>
                            <span class="has_error" v-if="errors.product_number_error">{{ errors.product_number_error }}</span>
                        </div>

                        <div class="form-group">
                            <label>تعداد قابل سفارش در سبد خرید : </label>
                            <cleave :options="options" v-model="formInput.max_number_order" class="form-control left" ></cleave>
                            <span class="has_error" v-if="errors.max_number_order_error">{{ errors.max_number_order_error }}</span>
                        </div>

                        <div class="form-group">
                            <label>تاریخ شروع : </label>
                            <input type="text" v-model="date1" id="pcal1" class="form-control" style="text-align:center" />
                        </div>

                        <div class="form-group">
                            <label>تاریخ پایان : </label>
                            <input type="text" v-model="date2" id="pcal2" class="form-control" style="text-align:center" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" v-on:click="add()">افزودن</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    export default {
        name: "AmazingOffersComponent",
        data(){
            return {
                ProductList:{data:[]},
                page:1,
                formInput:{
                    price1:'',
                    price:'',
                    product_number:'',
                    max_number_order:'',
                },
                options:{
                    numeral:true
                },
                date1:'',
                date2:'',
                select_key:-1,
                product_id:-1,
                send_form:true,
                show_message_box:false,
                errors:{
                    price1_error:false,
                    price_error:false,
                    product_number_error:false,
                    max_number_order_error:false,
                },
                label:{
                    price1:'هزینه محصول',
                    price:'هزینه محصول برای فروش',
                    product_number:'تعداد موجودی محصول',
                    max_number_order:'تعداد قابل سفارش در سبد خرید',
                },
                search_text:'',
                server_errors:null
            }
        },
        mounted() {
            this.getProductList(1)
        },
        methods:{
            getProductList:function (page) {
                this.page = page;
                const url = this.$siteUrl+'admin/ajax/getProduct?page='+page+"&search_text="+this.search_text;
                this.axios.get(url).then(response=>{
                    this.ProductList = response.data;
                });
            },
            getRow : function (index) {
                ++index;
                let k = (this.page-1)*5;
                k = k + index;
                return k;
            },

            show_box :function (item_id,key) {
                if(this.send_form == true)
                {
                    this.server_errors=false;
                    this.product_id = item_id;
                    this.select_key = key;
                    this.formInput.price1 = this.ProductList.data[key].price;
                    this.formInput.product_number = this.ProductList.data[key].product_number;
                    this.formInput.max_number_order = this.ProductList.data[key].max_number_order;
                    this.date1 = this.ProductList.data[this.select_key].offers_first_date;
                    this.date2 = this.ProductList.data[this.select_key].offers_last_date;
                    $("#priceBpx").modal('show');
                }
            },

            add :function () {
                this.date1=$("#pcal1").val();
                this.date2=$("#pcal2").val();

                if(this.validateForm())
                {
                    this.send_form = false;

                    const formData = new FormData();
                    formData.append('price1',this.formInput.price1);
                    formData.append('price',this.formInput.price);
                    formData.append('product_number',this.formInput.product_number);
                    formData.append('max_number_order',this.formInput.max_number_order);
                    formData.append('date1',this.date1);
                    formData.append('date2',this.date2);


                    const url = this.$siteUrl+"admin/add_amazingOffers/"+this.product_id;
                    this.axios.post(url,formData).then(response=>{
                        if (response.data =='ok'){
                            this.send_form = true;
                            $("#priceBpx").modal('hide');
                            this.ProductList.data[this.select_key].offers=1;
                            this.ProductList.data[this.select_key].price1=this.formInput.price1;
                            this.ProductList.data[this.select_key].price=this.formInput.price;
                            this.ProductList.data[this.select_key].product_number=this.formInput.product_number;
                            this.ProductList.data[this.select_key].max_number_order=this.formInput.max_number_order;
                            this.ProductList.data[this.select_key].offers_first_date=this.date1;
                            this.ProductList.data[this.select_key].offers_last_date=this.date2;
                        }
                        // else if (response.data.error!=undefined)
                        // {
                        //     this.send_form=true;
                        // }
                        else{
                            this.server_errors=response.data;
                            this.send_form=true;
                        }
                    });
                }
            },

            remove_offers:function (item_id,key) {
                this.product_id=item_id;
                this.select_key=key;
                this.show_message_box=true;
            },

            remove_of_list:function () {
                this.show_message_box = false;
                const url = this.$siteUrl+"admin/remove_amazingOffers/"+this.product_id;
                this.axios.post(url).then(response=>{
                    if(response.data!='error')
                    {
                        this.ProductList.data[this.select_key].offers=0;
                        this.ProductList.data[this.select_key].price1=response.data.price;
                        this.ProductList.data[this.select_key].product_number=response.data.product_number;
                        this.ProductList.data[this.select_key].max_number_order=response.data.max_number_order;

                    }
                })
            },

            validateForm:function ()
            {
                let result=true;
                for(let formInputKey in this.formInput)
                {
                    let  k=formInputKey+"_error";
                    if(this.formInput[formInputKey].toString().trim().length==0)
                    {
                        let message=this.label[formInputKey]+" نمی تواند خالی باشد";
                        this.errors[k]=message;
                        result=false;
                    }
                    else {
                        this.errors[k]=false;
                    }
                }
                return result;
            }
        }

    }
</script>

<style scoped>
    .message_box {
        width: 483px !important;
    }
</style>
