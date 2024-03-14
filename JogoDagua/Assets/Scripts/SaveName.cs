/*
 * SCRIPT PARA SALVAR O NOME DO JOGADOR
 * Atualizado por:     Thayllor Peres Devos dos Santos
 * E-mail:               thayllordossantos @gmail.com
*/

using UnityEngine;
using UnityEngine.UI;
using System.IO;
using UnityEngine.SceneManagement;


public class SaveName : MonoBehaviour{

    public GameObject tela;
    public GameObject confirmacao;
    [SerializeField]
    public Text nomedameninix;
    public Text aviso;

    public Text inputField;
    string name;

    public void Awake () {

        tela = GameObject.Find("Tela");
        confirmacao = GameObject.Find("Confirmacao");
    
        
        if (File.Exists(Application.persistentDataPath + "/Nome.txt")){
            SceneManager.LoadScene(1);
            print("O arquivo existe");
        }
    
    }


    void Start () {
        
        string filePath = Application.persistentDataPath + "/Nome.txt";
       
        if(inputField.text != ""){
            name = inputField.text;
            File.WriteAllText(filePath, name);
            SceneManager.LoadScene(1);
        }
        

    }
   

    // Update is called once per frame
    public void PegaNome()
    {
        if (nomedameninix.text == "")
        {
            aviso.text = "Coloque um nome valido por favor :)";
        }
        else
        {
            confirmacao.SetActive(true);
            Confirmacao script_conf = confirmacao.GetComponent<Confirmacao>();
            script_conf.nome.text = nomedameninix.text;
            tela.SetActive(false);
            
        }
    }

}