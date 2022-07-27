<?php 
namespace App\Http\Servis;
use Illuminate\Database\Eloquent\Model;
use App\Http\Repositories\SampelRepository;
use App\Helpers\ResponseFormatter;

use App\Models\Akun;

// interface PaymentInterface
// {
//     public function getDataPeymentMembers($member_id);
// }

class SampleServis {
// implements RepositoryInterface
    private $sampelRepository;
    public function __construct()
    {
        $this->sampelRepository = new SampelRepository();
    }

    public function getDataPeymentMembersServis($member_id){
        $email = $member_id['email'];
        $getSampelRepository = $this->sampelRepository->getDataPeymentMembers($email);
        return $getSampelRepository;
    }

    public function whereByEmailServis($credentials){
        $email = $credentials['email'];

        $getSampelRepository = $this->sampelRepository->whereByEmailRepository($email);
        if(isset($getSampelRepository)){
            $request = [
                'status' => 'succes', 
                'code' => 200, 
                'message' => 'Email Sudah Ada', 
                'data' => $getSampelRepository
            ];
        }else{
            
            $inputMemberServis = $this->sampelRepository->getDataPeymentMembers($credentials);

            if($inputMemberServis){
                $request = [
                    'status' => 'succes', 
                    'code' => 201, 
                    'message' => 'Input Berhasil', 
                    'data' => $inputMemberServis
                ];
            }else{
                $request = [
                    'status' => 'filed', 
                    'code' => abort(404), 
                    'message' => 'Bad Request', 
                    'data' => $inputMemberServis
                ];
            }

            
        }
        return $request;

    }
    
}

?>
