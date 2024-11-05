<div>

        <script>
                document.addEventListener('livewire:load', () => {
                        document.addEventListener('alpine:init', () => {
                                Alpine.data('searchComponent', () => ({
                                        // open: $wire.entangle('showModal'),
                                        // cadOpen: $wire.entangle('showCadModal'),
                                        tabService: $wire.entangle('tabService'),
                                        tabRepeat: $wire.entangle('tabRepeat'),
                                        tabCustomer: $wire.entangle('tabCustomer'),
                                        tabEmployee: $wire.entangle('tabEmployee'),
                                        selectTab(selected) {
                                                switch (selected) {
                                                        case 'tabService':
                                                                this.tabService = true;
                                                                this.tabRepeat = false;
                                                                this.tabCustomer = false;
                                                                this.tabEmployee = false;
                                                                this.$refs.tabServiceElement.classList.add('active', 'success');
                                                                this.$refs.tabRepeatElement.classList.remove('active', 'success');
                                                                this.$refs.tabCustomerElement.classList.remove('active', 'success');
                                                                this.$refs.tabEmployeeElement.classList.remove('active', 'success');
                                                                break;
                                                        case 'tabRepeat':
                                                                this.tabService = false;
                                                                this.tabRepeat = true;
                                                                this.tabCustomer = false;
                                                                this.tabEmployee = false;
                                                                this.$refs.tabServiceElement.classList.remove('active', 'success');
                                                                this.$refs.tabRepeatElement.classList.add('active', 'success');
                                                                this.$refs.tabCustomerElement.classList.remove('active', 'success');
                                                                this.$refs.tabEmployeeElement.classList.remove('active', 'success');
                                                                break;
                                                        case 'tabCustomer':
                                                                this.tabService = false;
                                                                this.tabRepeat = false;
                                                                this.tabCustomer = true;
                                                                this.tabEmployee = false;
                                                                this.$refs.tabServiceElement.classList.remove('active', 'success');
                                                                this.$refs.tabRepeatElement.classList.remove('active', 'success');
                                                                this.$refs.tabCustomerElement.classList.add('active', 'success');
                                                                this.$refs.tabEmployeeElement.classList.remove('active', 'success');
                                                                break;
                                                        case 'tabEmployee':
                                                                this.tabService = false;
                                                                this.tabRepeat = false;
                                                                this.tabCustomer = false;
                                                                this.tabEmployee = true;
                                                                this.$refs.tabServiceElement.classList.remove('active', 'success');
                                                                this.$refs.tabRepeatElement.classList.remove('active', 'success');
                                                                this.$refs.tabCustomerElement.classList.remove('active', 'success');
                                                                this.$refs.tabEmployeeElement.classList.add('active', 'success');
                                                                break;
                                                }
                                        },
                                }));
                        });
                });
        </script>

</div>