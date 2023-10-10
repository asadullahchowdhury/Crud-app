const apiVersion = '';

const apiRoutes = {

    // Auth
    Login: apiVersion + 'login',


    // product
    ProductCreate: apiVersion + 'product/create',
    ProductUpdate: apiVersion + 'product/update',
    ProductList: apiVersion + 'product/list',
    ProductSingle: apiVersion + 'product/single',
    ProductDelete: apiVersion + 'product/delete',

    // category
    CategoryCreate: apiVersion + 'category/create',
    CategoryUpdate: apiVersion + 'category/update',
    CategoryList: apiVersion + 'category/list',
    CategorySingle: apiVersion + 'category/single',
    CategoryDelete: apiVersion + 'category/delete',

    /*Media*/
    Media: apiVersion + 'media/upload',
}

export default apiRoutes
