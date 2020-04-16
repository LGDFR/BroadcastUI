<?php
namespace LGDFR\BroadcastUI;

use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use LGDFR\BroadcastUI\FormAPI\CustomForm;
class Main extends PluginBase{
    public function onEnable(){
        $this->getLogger()->info("is well activate");
    }
    public function onDisable(){
        $this->getLogger()->info("is disabled");
    }
    public function onLoad(){
        $this->getLogger()->info("is well loaded");
    }
    public function onCommand(CommandSender $sender,Command $cmd,string $label, array $args): bool
    {
        switch ($cmd->getName()){
            case "broadcastui":
                if($sender instanceof Player){
                      
                    $this->openMycustomToogleForm($sender);
                }
                break;
        }
        return true;
    }
    public function openMycustomToogleForm(Player $player) {
        
        
        
        $form = new CustomForm(function(Player $player,array $data = null){
            
            if($data === null){
                return true;
            }
            if($data[2] == true){
                
                Server::getInstance()->broadcastTitle($data[5],$data[6]);
                
                
            }else{
                
                    if($data[3] == false){
                        
                        Server::getInstance()->broadcastPopup("[§e".$data[4]."§f]".$data[5]);
                        
                        
                    }else{
                        Server::getInstance()->broadcastMessage("[§e".$data[4]."§f]".$data[5]);
                    }
            }});
            
            $form->SetTitle("BroadcastUI");
            // args[0]
            $form->addLabel("You have to choose an option");
            $form->addLabel("The plugin was created by (§bLGDFR§f)");
            $form->addToggle("Title",false);
            $form->addToggle("Popup | Message",false);
            $form->addInput("Your prefix §7(optional)",""); 
            $form->addInput("Your message or title §c(required)",""); 
            $form->addInput("sub title §7(optional)",""); 
            
            $form->sendToPlayer($player);
            
            return $form;
    }
    
}

