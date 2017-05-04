<?php echo '<?php' ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class {{$name}} extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for associating roles to users (Many-to-Many)
        Schema::create('{{ $roleUserPivotTable['name'] }}', function (Blueprint $table) {
            @foreach ($roleUserPivotTable['fkeys'] as $fkey)
            $table->integer('{{$fkey['fkey']}}')->unsigned();
            $table->foreign('{{$fkey['fkey']}}')->references('{{ $fkey['pkey'] }}')->on('{{ $fkey['name'] }}')
            ->onUpdate('cascade')->onDelete('cascade');
            @endforeach
            $table->primary(['{{$roleUserPivotTable['fkeys'][0]['fkey']}}', '{{$roleUserPivotTable['fkeys'][1]['fkey']}}']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('{{ $roleUserPivotTable['name'] }}');
    }
}