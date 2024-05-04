using System.Collections;
using System.Collections.Generic;
using System.Runtime.Remoting;
using UnityEngine;
using UnityEngine.SceneManagement;
using System;
using Unity.Collections.LowLevel.Unsafe;

public class EndGame_Script : MonoBehaviour {
    
    private GameObject obj_status;  
    private status script_status;

    public GameObject End_Game;
    
    public GameObject bd;
    public Mybdscript script_bd;

    private bool gameEnded = false;
   

    void Start() {
        obj_status = GameObject.Find("Status");
        script_status = obj_status.GetComponent<status>();

        bd = GameObject.Find("Mybd");         
        script_bd = bd.GetComponent<Mybdscript>();
        
        //End_Game = GameObject.FindGameObjectWithTag("End_Layer");

        if (End_Game != null) {
            End_Game.SetActive(false);
        }
    }

    void Update() {
        EndGame();  
    }

    void EndGame() {
        
        if (!gameEnded && script_status.win_Condition == 6) {
            End_Game.SetActive(true);
            Time.timeScale = 1f;

            string datahora = DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss");

            script_bd.Insert_in_jogo(script_bd.idjogo,  script_status.difi,          3      , script_status.Pontos,   -1, script_status.abertos, script_status.mascote , script_status.criada , datahora);
            script_bd.Salvar();
            
            if (Application.internetReachability != NetworkReachability.NotReachable){
                script_bd.EnviarProBanco();
            }

            gameEnded = true;
        }
        else if (!gameEnded && (script_status.lose_Condition + script_status.win_Condition) == 6){
            script_status.perdeu = true;
            SceneManager.LoadScene(5);
            gameEnded = true;
        }
    }
}
