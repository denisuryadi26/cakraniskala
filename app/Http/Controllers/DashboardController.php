<?php

/**
 * @author Dodi Priyanto<dodi.priyanto76@gmail.com>
 */

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Repository\SettingRepository;
use App\Service\SettingService;
use App\Service\UserService;
use App\Service\Generator\UnlatService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelInterface;

class DashboardController extends CoreController
{
    private $menu;
    private $settingVal;
    private $unlatService;
    private $userService;

    public function __construct(UnlatService $unlatService, UserService $userService)
    {
        $this->menu = $this->get_menu();
        $this->settingVal = $this->get_all_setting();
        $this->unlatService = $unlatService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('admin.contents.index', [
            'menu' => ($this->menu ? $this->menu : ''),
            'allunlat' => $this->unlatService->all(),
            'unlat' => $this->unlatService->count(),
            'all_user' => $this->userService->countAll(),
            'user_aktif' => $this->userService->countActif(),
            'user_inaktif' => $this->userService->countInactif(),
            'setting' => ($this->settingVal ? $this->settingVal : '')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function deleteFileContent(Request $request, SettingRepository $repository): JsonResponse
    {
        dd('a');
        $key = $request->request->get('key');
        dd($key);
        $key = explode(',', $key);
        $id = $key[0];
        $name = $key[1];
        $tbl = $key[2];

        $entitiy = '';
        $file = $repository->findOneBy(['key' => $key]);
        dd($file);


        if (empty($entitiy)) {
            throw new NotFoundHttpException();
        }

        $newFileContent = '';
        //        if ($file) {
        //            $fileContent = json_decode($file);
        //
        //            $fileContents = array_filter($fileContent, function ($e) use ($name) {
        //                return $e->file !== $name;
        //            });
        //
        //            $img = $kernel->getProjectDir().'/'.$settingService->getValue('upload_dir').'/'.$dir.'/'.$name;
        //            if (file_exists($img)) {
        //                unlink($img);
        //            }
        //
        //            $fileContents = (count($fileContents) > 0 ? array_values($fileContents) : []);
        //
        //            $newFileContent = json_encode($fileContents);
        //            switch ($tbl) {
        //                case 'time':
        //                    $entitiy->setImage($newFileContent);
        //                    break;
        //                case 'quantity':
        //                    $entitiy->setImage($newFileContent);
        //                    break;
        //                case 'weekly':
        //                    $entitiy->setFile($newFileContent);
        //                    break;
        //                case 'notImplement':
        //                    $entitiy->setisImplementFile($newFileContent);
        //                    break;
        //                case 'eksternal':
        //                    $entitiy->setFile($newFileContent);
        //                    break;
        //                default:
        //                    $entitiy->setisImplementFile($newFileContent);
        //                    break;
        //            }
        //            $service->save($entitiy);
        //
        //            return new JsonResponse(['status' => 'OK', 'files' => $newFileContent]);
        //        } else {
        //            return new JsonResponse(['status' => 'faile', 'files' => '']);
        //        }
        //
        //        return new JsonResponse(['status' => 'OK', 'files' => '']);
    }

    public function getCardData(Request $request)
    {
        $areaId = $request->get('area_id');
        $dataCard = $this->dashboardService->getCardData($areaId);
        //        $dataChart = $this->dashboardanalyticService->getChartData($areaId);
        return response()->json(['data' => $dataCard], 200);
    }
}
