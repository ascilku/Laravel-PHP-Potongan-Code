<?php 
namespace App\Http\Repositories;
use Illuminate\Database\Eloquent\Model;
use App\Models\Akun;

// interface PaymentInterface
// {
//     public function getDataPeymentMembers($member_id);
// }

class SampelRepository {
// implements RepositoryInterface
    public function getDataPeymentMembers($member_id){
        $akun = new Akun;
            $akun->name = $member_id['name'];
            $akun->email = $member_id['email'];
            $akun->email_verified_at = "s";
            $akun->password = $member_id['password'];
        $akun->save();
        return $akun;
    }

    public function whereByEmailRepository($credentials){
        
        $email = Akun::where('email', $credentials)->first();

        return $email;

    }
    
}

?>
