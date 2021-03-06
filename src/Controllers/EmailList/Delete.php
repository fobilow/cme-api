<?php

/**
 * @author  oke.ugwu
 */
namespace CmeApi\Controllers\EmailList;

use CmeApi\AbstractController;
use CmeKernel\Core\CmeKernel;
use Slim\Http\Request;

class Delete extends AbstractController
{
  public function _process(Request $request)
  {
    $result['status']  = 'success';
    $result['result']    = null;
    $result['request'] = $request->post();
    try
    {
      $listId = $request->post('id');
      if($listId)
      {
        $result['result'] = CmeKernel::EmailList()->delete($listId);
        $result['message'] = 'List successfully deleted.';
      }
      else
      {
        throw new \Exception("list_id must be specified");
      }
    }
    catch(\Exception $e)
    {
      $result['status']  = 'fail';
      $result['error'] = $e->getMessage();
    }

    return $result;
  }
}
