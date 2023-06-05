/*import DetailField from './fields/DetailField.vue'
import FormField from './fields/FormField.vue'
import IndexField from './fields/IndexField.vue'*/
import Tool from './pages/Tool.vue'

Nova.booting(app => {
    Nova.inertia('NovaLaraCache', Tool)

    /*app.component('index-nova-file-manager-field', IndexField)
    app.component('detail-nova-file-manager-field', DetailField)
    app.component('form-nova-file-manager-field', FormField)*/
})
