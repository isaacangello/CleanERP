<div>
    @script
        <script>

            Alpine.data( 'multiSelectAlpine',() => {

                return {
                    selectOpen: false,
                    options: $wire.billings,
                    selectedOptions: $wire.entangle('billingsSelected'),
                    selectedValues: $wire.entangle('selectedValues'),
                    joinSelectedValues() {
                        if(this.selectedValues.length === 0) {
                            return 'Select options';
                        }
                        const tempValues = new  Set(this.selectedValues);
                        return Array.from(tempValues).join(', ');
                    },
                    toggleOption(option) {
                        if (this.selectedOptions.includes(option)) {
                            this.selectedOptions = this.selectedOptions.filter(item => item !== option);
                        } else {
                            this.selectedOptions.push(option);
                        }
                    },
                    toggleValues(option) {
                        if (this.selectedValues.includes(option)) {
                            this.selectedValues = this.selectedValues.filter(item => item !== option);
                        } else {
                            this.selectedValues.push(option);
                        }
                    }
                }
            }
            );

        </script>
    @endscript
</div>