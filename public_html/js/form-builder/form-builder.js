const app = new Vue({
    el: '#app',
    data: {
        error: '',
        tag: 'build-form',
        name: 'build-form',
        new_line: ',',
        delimiter: '|',
        extras: [
            {heading: '', value: ''}
        ],
        attributes: [
            {
                id: 0,
                heading: 'questions',
                fields: [
                    {label: 'Name', name: 'Your Name', type: 'text', value: '', comment: ''}
                ]
            }
        ],
        id: 0,
        submit_button_name: 'Submit',
        short_code: '',
        imported_short_code: ''
    },
    watch: {
        tag: 'createShortcode',
        name: 'createShortcode',
        new_line: 'createShortcode',
        delimiter: 'createShortcode',
        attributes: {
            handler: 'createShortcode',
            deep: true
        },
        extras: {
            handler: 'createShortcode',
            deep: true
        },
        submit_button_name: 'createShortcode'
    },
    methods: {
        createShortcode: function () {
            const vm = this;
            this.short_code = '[' + this.tag + ' ';
            if(this.name !== '' && this.name !== null && this.name !== undefined){ this.short_code += 'name="' + this.name + '" '; }
            if(this.new_line !== '' && this.new_line !== null && this.new_line !== undefined){ this.short_code += 'new_line="' + this.new_line + '" '; }
            if(this.delimiter !== '' && this.delimiter !== null && this.delimiter !== undefined){ this.short_code += 'delimiter="' + this.delimiter + '" '; }
            if(this.submit_button_name !== '' && this.submit_button_name !== null && this.submit_button_name !== undefined){ this.short_code += 'submit_button_name="' + this.submit_button_name + '" '; }
            this.extras.forEach(function(extra){
                if(extra.heading !== '' && extra.heading !== null && extra.heading !== undefined){ vm.short_code += extra.heading.replace(/ /g, "_").toLowerCase() + '="' + extra.value + '" '; }
            });
            this.attributes.forEach(function(attribute) {
                if(attribute.heading !== '' && attribute.heading !== null && attribute.heading !== undefined){
                    vm.short_code += attribute.heading + '=' + '"';
                    attribute.fields.forEach(function(field) {
                        vm.short_code += field.label;
                        vm.short_code += vm.delimiter;
                        if(field.name !== '' && field.name !== null && field.name !== undefined){ vm.short_code += field.name.replace(/ /g, "-").toLowerCase(); }
                        vm.short_code += vm.delimiter;
                        if(field.type !== '' && field.type !== null && field.type !== undefined){ vm.short_code += field.type; }
                        vm.short_code += vm.delimiter;
                        if(field.value !== '' && field.value !== null && field.value !== undefined){ vm.short_code += field.value; }
                        vm.short_code += vm.delimiter;
                        if(field.comment !== '' && field.comment !== null && field.comment !== undefined){ vm.short_code += field.comment; }
                        vm.short_code += vm.new_line;
                    });
                    if(vm.short_code.charAt(vm.short_code.length-1) ===','){ vm.short_code = vm.short_code.slice(0,-1); }
                    vm.short_code += '" ';
                }
            });
            this.short_code += ']';
        },
        AddExtraRow: function(){
            this.extras.push({heading: '', value: ''});
        },
        RemoveExtraRow: function(){
            if(this.extras.length > 1){
                this.extras.pop();
            }
        },
        AddAttributeRow: function() {
             this.id++;
            this.attributes.push(
                {
                    id: this.id,
                    heading: 'default',
                    fields: [
                        {label: '', name: '', type: '', value: '', comment: ''}
                    ]
                }
            );
        },
        RemoveAttributeRow: function() {
            if(this.attributes.length > 1){
                this.attributes.pop();
            }
        },
        AddFieldToAttribute: function(attribute){
            attribute.fields.push({label: '', name: '', type: '', value: '', comment: ''});
        },
        RemoveFieldFromAttribute: function(attribute){
            if(attribute.fields.length > 1){
                attribute.fields.pop();
            }
        },
        copyShortcode: function() {
            const vm = this;
            var shortCodeToCopy = document.querySelector('#short_code');
            shortCodeToCopy.setAttribute('type', 'text');
            shortCodeToCopy.select();
            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successfully' : 'unsuccessfully';
                this.error = '[short-code] was copied ' + msg;
            } catch (err) {
                this.error = 'Oops, unable to copy';
            }
            shortCodeToCopy.setAttribute('type', 'hidden');
            window.getSelection().removeAllRanges();
            setTimeout(function(){
                vm.error = '';
            },5000);
        },
        populateFields: function(){
            const vm = this;
            axios.post('/app/api/shortcode',{
                shortcode: vm.imported_short_code
            }).then(function (response) {
                    if(response.data.hasOwnProperty('error')){
                        vm.error = 'Error: ' + response.data.error;
                    }else{
                        vm.attributes = [];
                        vm.extras = [];
                        vm.id = 0;
                        vm.tag = response.data.tag;
                        vm.name = response.data.name;
                        vm.new_line = response.data.new_line;
                        vm.delimiter = response.data.delimiter;
                        vm.submit_button_name = response.data.submit_button_name;
                        var attributes = response.data.attributes;
                        Object.keys(attributes).forEach(function(key){
                            var fields = [];
                            attributes[key].forEach(function(field){
                                field.label = field.label.replace(/(^\s+|\s+$)/g,'');
                               fields.push(field)
                            });
                            vm.attributes.push(
                                {
                                    id: vm.id,
                                    heading: key,
                                    fields:  fields
                                }
                            );
                            vm.id++;
                        });
                        vm.cleanUpAttributes(response.data);
                        Object.keys(response.data).forEach(function(key){
                           vm.extras.push({heading: key, value: response.data[key]});
                        });
                        vm.error = '[short-code] was imported successfully';
                    }
                }).catch(function(e) {
                    vm.error = '' + e;
            });
            setTimeout(function(){
                vm.error = '';
            },5000);
        },
        cleanUpAttributes: function(data) {
            delete data.tag;
            delete data.name;
            delete data.new_line;
            delete data.delimiter;
            delete data.submit_button_name;
            delete data.attributes;
            delete data.shortcode;
        }
    },
    mounted: function() {
        this.createShortcode();
    }
});