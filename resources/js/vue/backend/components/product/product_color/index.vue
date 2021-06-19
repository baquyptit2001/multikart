<template>
    <span>
        <side-bar/>
        <head-top/>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <el-dialog title="Thêm nhãn hiệu" :visible.sync="addColorForm">
                <el-form :model="form">
                    <el-form-item label="Tên màu" :label-width="formLabelWidth">
                        <el-input v-model="form.name" autocomplete="off"></el-input>
                    </el-form-item>
                    <el-form-item label="Mã màu" :label-width="formLabelWidth">
                        <el-color-picker v-model="form.color"></el-color-picker>
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
                    <el-button @click="addColorForm = false">Cancel</el-button>
                    <el-button type="primary" @click="addItem()">Confirm</el-button>
                </span>
                </el-dialog>
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Màu sản phẩm</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Màu sản phẩm</li>
                            </ol>
                            <el-button type="button" class="btn btn-info d-none d-lg-block m-l-15" @click="addColorForm = true"><i class="fa fa-plus-circle"></i> Create New</el-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </span>
</template>

<script>

import sideBar from '../../sidebar.vue'
import headTop from '../../header.vue'

export default {
    components:{
        sideBar,
        headTop
    },
    data: function(){
        return {
            addColorForm: false,
            formLabelWidth: '120px',
            form: {
                name: '',
                color:'',
                status: true
                // fileList:[],
            },
        }
    }
}
</script>