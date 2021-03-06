<?php

/**
 * @author  oke.ugwu
 */
namespace CmeApi\Controllers\EmailList;

use CmeApi\AbstractController;
use CmeData\ListData;
use CmeKernel\Core\CmeKernel;
use Slim\Http\Request;

class Update extends AbstractController
{

  public function _process(Request $request)
  {
    $result['status']  = 'success';
    $result['result']    = null;
    $result['request'] = $request->post();
    try
    {
      /**
       * @var ListData $data
       */
      $data = ListData::hydrate($request->post());
      if($data->id)
      {
        $result['result'] = CmeKernel::EmailList()->update($data);
      }
      else
      {
        throw new \Exception(
          "List ID is missing a name. An id is required to create a list"
        );
      }

      $result['message'] = 'List successfully updated.';
    }
    catch(\Exception $e)
    {
      $result['status']  = 'fail';
      $result['error'] = $e->getMessage();
    }

    return $result;
  }
}
