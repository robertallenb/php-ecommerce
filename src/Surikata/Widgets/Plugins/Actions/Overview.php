<?php

namespace ADIOS\Actions\Plugins;

class Overview extends \ADIOS\Core\Action {
  public function render() {
    $plugins = $this->adios->plugins;

    $cardsHtml = "";
    foreach ($plugins as $pluginName) {
      if ($this->adios->actionExists("Plugins/{$pluginName}/Main")) {
        $pluginObject = $this->adios->getPlugin($pluginName);
        $manifest = $pluginObject->manifest();

        if (empty($manifest['logo'])) {
          $logoHtml = "
            <i
              class='{$manifest['faIcon']}'
              style='color:#888888;font-size:7em;cursor:pointer;margin-top:60px'
              onclick='desktop_render(\"Plugins/{$pluginName}/Main\");'
            ></i>
          ";
        } else {
          $logoHtml = "
            <img
              src='{$this->adios->config['url']}/adios/assets/plugins/{$pluginName}/~/{$manifest['logo']}'
              style='max-width:200px;max-height:200px;cursor:pointer'
              onclick='desktop_render(\"Plugins/{$pluginName}/Main\");'
            />
          ";
        }

        $cardsHtml .= "
          <div class='col-lg-3 col-md-12'>
            <div class='card shadow mb-2'>
              <div class='card-header py-3'>
                <h6 class='m-0 font-weight-bold text-primary'>".hsc($manifest['title'])."</h6>
              </div>
              <div class='card-body text-center'>
                <div style='height:250px'>
                  {$logoHtml}
                </div>
                <p class='my-4'>".hsc($manifest['description'])."</p>
                <a
                  href='javascript:void(0)'
                  class='btn btn-light'
                  onclick='desktop_render(\"Plugins/{$pluginName}/Main\");'
                >Manage</a>
              </div>
            </div>
          </div>
        ";
      }
    }

    $html = "
      <div class='row'>
        {$cardsHtml}
      </div>
    ";

    return $html;
  }
}