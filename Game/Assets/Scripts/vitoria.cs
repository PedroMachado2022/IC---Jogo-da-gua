/*
JOGO DA ÁGUA: Controle das interações a porta final
Desenvolvido por:     Jhordan Silveira de Borba
E-mail:               jhordandecacapava@gmail.com
Website:              https://sapogithub.github.io
Mais informações:     https://github.com/SapoGitHub/Repositorio-Geral/wiki/Jogo-da-%C3%A1gua
2018
]*
Atualizado por:     Thayllor Peres Devos dos Santos
E-mail:               thayllordossantos@gmail.com
2019

Atualizado por:     Pedro Machado Araújo
E-mail:             pedro.machado.rs@hotmail.com
2023/2024

*/

using UnityEngine;
using UnityEngine.SceneManagement;
using System;

public class vitoria : MonoBehaviour
{

    private GameObject obj_status;  //Para acessar o status
    private status script_status;
    public GameObject bd;
    public Mybdscript script_bd;

    public bool Testezinho;

    public bool Next2;

    private bool Reset = false;
    private bool Quit_conditional = false;


    //Função para marcar que entramos dentro
    private void Start(){
        obj_status = GameObject.Find("Status");     //Vamos acesasr o objeto do status
        script_status = obj_status.GetComponent<status>();
        
        bd = GameObject.Find("Mybd");         
        script_bd = bd.GetComponent<Mybdscript>();
    }

    private void OnTriggerEnter2D(Collider2D collision)
    { 
        
        //Se temos a chave
        if (script_status.Chave == true)
        {   
            // if (Application.internetReachability != NetworkReachability.NotReachable){
            //     //tem internet
            //     script_bd.EnviarProBanco();
            // }
            
            if (script_status.fase == 1){
                Time.timeScale = 0f;
                Testezinho = true;
                string datahora = DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss");

                
                //(              int jogo_id,   string dificuldade,    int finalizado,     int pontos      ,       int problemas              ,     int abertos      ,     string mascote    ,   string created     ,         string modified               )
                script_bd.Insert_in_jogo(script_bd.idjogo,   script_status.difi,          1       , script_status.Pontos,   11-  script_status.vazamento, script_status.abertos, script_status.mascote , script_status.criada , datahora);
                // script_bd.Salvar();

                // if (Application.internetReachability != NetworkReachability.NotReachable){
                //     //tem internet
                //     script_bd.EnviarProBanco();
                // }
            
                
                script_status.Chave = false;
                script_status.Vida = 100;
                script_status.vazamento = 8;
                script_status.Regador = 0;
                script_status.Ferramentas = 0;   
            }
            else if(script_status.fase == 2){
                Time.timeScale = 0f;
                Testezinho = true;
                
                string datahora = DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss");
                                                            
                script_bd.Insert_in_jogo(script_bd.idjogo,  script_status.difi,          2       , script_status.Pontos,   8-  script_status.vazamento, script_status.abertos, script_status.mascote , script_status.criada , datahora);
                // script_bd.Salvar();
                // if (Application.internetReachability != NetworkReachability.NotReachable){
                //     //tem internet
                //     script_bd.EnviarProBanco();
                // }
                
                script_status.Vida = 100;
                script_status.vazamento = 11;
                script_status.Ferramentas = 0; 
            }
            
            else {
                SceneManager.LoadScene(5);
            }
            
        }
    }
    
    // FUNÇÕES TOTALMENTE NOVAS (2023/2024)

    public void Update(){
        if(script_status.fase == 3){
            REstart();
            QuitGame();
            
        }else{
            
        }
    }

    // Função utilizada para receber o click de reiniciar o jogo após o player ganhar
    public void ResetGame(){
        Reset = true;
    }

    // Função que reinicia o jogo
    public void REstart(){
        if(Reset == true){
            // Destruimos o script que guarda tudo do jogo, para reiniciar em branco
            GameObject.Destroy(obj_status);
            GameObject.Destroy(bd);
            // Carrega o menu de seleção
            SceneManager.LoadScene(1);
        }
    }

    // Função utilizada para receber o click de sair do jogo após o player ganhar
    public void QuitButton(){
        Quit_conditional = true;
    }

    // Função que sai do jogo
    public void QuitGame(){
        // Caso o player deseje sair (pressione o botão "Sair")
        if(Quit_conditional == true){
            // Fechamos o jogo
            Application.Quit();
        }
    }
}