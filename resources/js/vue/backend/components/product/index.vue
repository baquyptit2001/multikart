<template>
    <span>
        <head-top/>
        <side-bar/>
        <div class="page-wrapper">
            <div class="container-fluid">
                <el-dialog title="Thêm sản phẩm" :visible.sync="addProductForm">
                <el-form :model="form">
                    <el-form-item label="Tên sản phẩm" :label-width="formLabelWidth">
                        <el-input v-model="form.name" autocomplete="off"></el-input>
                    </el-form-item>
                    <div class="row">
                        <div class="col-lg-6">
                            <el-form-item label="Nhãn hiệu" :label-width="formLabelWidth">
                                <el-select v-model="form.brand_id" placeholder="Chọn nhãn hiệu">
                                    <!-- <el-option  label="Danh mục cha" value="0"></el-option> -->
                                    <el-option  v-for="item in brands" :key="item.id" :label="item.name" :value="item.id"></el-option>
                                </el-select>
                            </el-form-item>
                        </div>
                        <div class="col-lg-6">
                            <el-form-item label="Danh mục" :label-width="formLabelWidth">
                                <el-select v-model="form.category_id" placeholder="Chọn danh mục">
                                    <!-- <el-option  label="Danh mục cha" value="0"></el-option> -->
                                    <el-option  v-for="item in categories" :key="item.id" :label="item.name" :value="item.id"></el-option>
                                </el-select>
                            </el-form-item>
                        </div>
                        <div class="col-lg-6">
                            <el-form-item label="Màu sắc" :label-width="formLabelWidth">
                                <el-select v-model="form.color_id" multiple collapse-tags placeholder="Màu sắc">
                                    <el-option
                                    v-for="item in colors"
                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id">
                                    <span style="float: left">{{ item.name }}</span>
                                    <span :style="'float: right; width:20px;height:20px;background:'+ item.color_code"></span>
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </div>
                        <div class="col-lg-6">
                            <el-form-item label="Kích cỡ" :label-width="formLabelWidth">
                                <el-select
                                    v-model="form.size_id"
                                    multiple
                                    collapse-tags
                                    style="margin-left: 20px;"
                                    placeholder="Chọn kích cỡ">
                                    <el-option
                                    @click="abc(item.id)"
                                    v-for="item in sizes"
                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id">
                                    </el-option>
                                </el-select>
                            </el-form-item>
                        </div>
                    </div>
                    <el-form-item label="Giá sản phẩm" :label-width="formLabelWidth">
                        <el-input v-model="form.price" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Giá khuyến mãi" :label-width="formLabelWidth">
                        <el-input v-model="form.sale_price" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Tóm tắt" :label-width="formLabelWidth">
                        <el-input v-model="form.slug" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Chi tiết sản phẩm" :label-width="formLabelWidth">
                        <el-input v-model="form.description" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Ảnh sản phẩm" :label-width="formLabelWidth">
                        <el-input v-model="form.image" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Ảnh chi tiết" :label-width="formLabelWidth">
                        <el-input v-model="form.imageDetail" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Trạng thái" :label-width="formLabelWidth">
                        <el-tooltip content="Ẩn/Hiện" placement="top">
                            <el-switch
                                v-model="form.status"
                                active-value="1"
                                inactive-value="0">
                            </el-switch>
                        </el-tooltip>
                    </el-form-item>
                </el-form>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="addProductForm = false">Cancel</el-button>
                    <el-button type="primary" @click="addItem()">Confirm</el-button>
                </span>
                </el-dialog>
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Sản phẩm</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Sản phẩm</li>
                            </ol>
                            <el-button type="button" class="btn btn-info d-none d-lg-block m-l-15" @click="addProductForm = true"><i class="fa fa-plus-circle"></i> Create New</el-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </span>
</template>

<script>

import headTop from '../header.vue'
import sideBar from '../sidebar.vue'

export default {
    components:{
        headTop,
        sideBar
    },
    data: function(){
        return{
            addProductForm: false,
            brands:[],
            colors:[],
            categories:[],
            sizes:[],
            form:{
                name:'',
                price:'',
                sale_price:'',
                description:'',
                slug:'',
                image:'',
                imageDetail:'',
                category_id:'',
                brand_id:'',
                size_id:'',
                color_id:'',
                status:true,
            },
            formLabelWidth: '150px',
        }
    },
    methods:{
        init(){
            axios.get('http://localhost:8000/api/backend/product/init')
            .then(response=>{
                this.categories = response.data[0];
                this.brands = response.data[1];
                this.sizes = response.data[2];
                this.colors = response.data[3];
            })
            .catch(error => {
                console.log(error);
            });
        },
        addItem(){
            console.log(this.form);
            if(this.form.name == ''){
                this.$notify({
                title: 'Lưu ý',
                message: 'Không được bỏ trống',
                type: 'warning'
                });
                return;
            }
            axios.post('http://localhost:8000/api/backend/product/store',{
                item: this.form,
            })
            .then(response=>{
                if(response.status == 200){
                    // this.item.name = "";
                    // this.$emit('reloadlist');
                    this.addProductForm = false;
                    this.$notify({
                    title: 'Thành công',
                    message: 'Thêm mới thành công',
                    type: 'success'
                    });
                    this.getList();
                }
            })
            .catch(error=>{
                console.log(error);
                this.$message.error(error);
            })
        }
    },
    async created(){
        await this.init();
    }
}
</script>