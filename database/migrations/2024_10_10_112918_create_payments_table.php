<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
 *
*       <option value="ApplePay">ApplePay</option>
     * <option value="Cash">Cash</option>
     * <option value="CashApp">CashApp</option>
     * <option value="Credit Card">CC (Credit Card)</option>
     * <option value="Cheque - Cash">Cheque - Cash</option>
     * <option value="Cheque - Empresa">Cheque - Empresa</option>
     * <option value="Cheque - Não Nom">Cheque - Não Nom</option>
     * <option value="Cheque - Nome Colab">Cheque - Nome Colab</option>
     * <option value="Gift Card">Gift Card</option>
     * <option value="Invoice - Original">Invoice - Original</option>
     * <option value="Invoice - Paypal">Invoice - Paypal</option>
     * <option value="Invoice - QuickBook">Invoice - QuickBook</option>
     * <option value="Invoice - Square">Invoice - Square</option>
     * <option value="Paypal">Paypal</option>
     * <option value="Request - CashApp">Request - CashApp</option>
     * <option value="Request - Venmo">Request - Venmo</option>
     * <option value="Request - Zelle">Request - Zelle</option>
     * <option value="Venmo">Venmo</option>
     * <option value="Venmo p/ colab">Venmo p/ colab</option>
     * <option value="Zelle">Zelle</option>
     * <option value="Zelle - Email">Zelle - Email</option>
     * <option value="Zelle p/ colab">Zelle p/ colab</option>
 */
    public array $payments= [
      ['title'=>'ApplePay','notes'=>'ApplePay'],
      ['title'=>'Cash','notes'=>'Cash'],
      ['title'=>'CashApp','notes'=>'CashApp'],
      ['title'=>'Credit Card','notes'=>'Credit Card'],
      ['title'=>'Cheque - Cash','notes'=>'Cheque - Cash'],
      ['title'=>'Cheque - Empresa','notes'=>'Cheque - Empresa'],
      ['title'=>'Cheque - Não Nom','notes'=>'Cheque - Não Nom'],
      ['title'=>'Cheque - Nome Colab','notes'=>'Cheque - Nome Colab'],
      ['title'=>'Gift Card','notes'=>'Gift Card'],
      ['title'=>'Invoice - Original','notes'=>'Invoice - Original'],
      ['title'=>'Invoice - Paypal','notes'=>'Invoice - Paypal'],
      ['title'=>'Invoice - QuickBook','notes'=>'Invoice - QuickBook'],
      ['title'=>'Invoice - Square','notes'=>'Invoice - Square'],
      ['title'=>'Paypal','notes'=>'Paypal'],
      ['title'=>'Request - CashApp','notes'=>'Request - CashApp'],
      ['title'=>'Request - Venmo','notes'=>'Request - Venmo'],
      ['title'=>'Request - Zelle','notes'=>'Request - Zelle'],
      ['title'=>'Venmo','notes'=>'Venmo'],
      ['title'=>'Venmo p/ colab','notes'=>'Venmo p/ colab'],
      ['title'=>'Zelle','notes'=>'Zelle'],
      ['title'=>'Zelle - Email','notes'=>'Zelle - Email'],
      ['title'=>'Zelle p/ colab','notes'=>'Zelle p/ colab'],
    ];

    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('title',50);
            $table->string('notes',300)->nullable();
            $table->softDeletes();
            $table->timestamps();

        });
        DB::table('payments')->insert($this->payments);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('payments');
        Schema::enableForeignKeyConstraints();
    }
};
