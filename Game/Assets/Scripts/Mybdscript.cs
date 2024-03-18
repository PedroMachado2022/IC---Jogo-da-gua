/*
 * SCRIPT PARA PARA FAZER TODOS OS OUTROS SAVES E ENVIAR PARA O BANCO
 * Atualizado por:     Thayllor Peres Devos dos Santos
 * E-mail:               thayllordossantos @gmail.com

 * Atualizado por:     Pedro Machado Araújo
 * E-mail:             pedro.machado.rs@htomail.com
 * Ano : 2024

*/
using System.Collections;
using UnityEngine;
using System;
using System.Runtime.Serialization.Formatters.Binary;
using System.IO;
using UnityEngine.Networking;


public class Mybdscript : MonoBehaviour
{
    public int idjogo;
    public string erro;
    public void Start()
    {
        DontDestroyOnLoad(this);
    }

    public void Insert_in_jogo(int id, string dificuldade, int finalizado, int pontos, int problemas, int abertos, string mascote, string created, string modified)
    {
        string path = Application.persistentDataPath + "/Jogos.txt";
        string texto;
        texto = File.ReadAllText(path);
        texto += id.ToString() + "," + dificuldade + "," + finalizado.ToString() + "," + pontos.ToString() + "," + problemas.ToString() + "," + abertos.ToString() + "," + mascote + "," + created + "," + modified + ";";
        File.WriteAllText(path, texto);
        
    } 
    //int objeto_id, string objeto,
    public void Insert_in_jogadas(int jogo_id, int fase, int pontos, int vida, string objeto, string acao, string intencao, string created, string modified)
    {
        string path = Application.persistentDataPath + "/Jogadas.txt";
        string texto;
        texto = File.ReadAllText(path);
        texto += jogo_id.ToString() + "," + fase.ToString() + "," + pontos.ToString() + "," + vida.ToString() + ","  + objeto + "," + acao + "," + intencao + "," + created + "," + modified + ";";
        File.WriteAllText(path, texto);
        
    }
    
    public int qual_jogo(){

        int jogo;
        Numero numerinho = new Numero();

        string filePath = Application.persistentDataPath + "/Numero_Game.sav";

        if (File.Exists(filePath)){
            using (FileStream fs = new FileStream(filePath, FileMode.Open)){
                BinaryFormatter bf = new BinaryFormatter();
                numerinho = bf.Deserialize(fs) as Numero;
            }

            numerinho.numero += 1;
            jogo = numerinho.numero;
        }
        else{
            numerinho.numero = 0; // Inicia em 0 se o arquivo não existir
            jogo = numerinho.numero;
        }

        idjogo = jogo;

        using (FileStream fs = new FileStream(filePath, FileMode.Create)){
            
            BinaryFormatter bf = new BinaryFormatter();
            bf.Serialize(fs, numerinho);

        }

        return jogo;
    }
    public void Salvar()
    {
        string path = Application.persistentDataPath + "/arquivo.txt";
        string nome = File.ReadAllText(Application.persistentDataPath + "/Nome.txt");
        string jogos = File.ReadAllText(Application.persistentDataPath + "/Jogos.txt");
        string jogadas = File.ReadAllText(Application.persistentDataPath + "/Jogadas.txt");
        string banco;
        
        if (jogadas != "")
        {
            jogadas = jogadas.Remove(0, 1);
            banco = nome + "|" + jogos + "|" + jogadas;
        }
        else
        {

            banco = nome + "|" + jogos;
        }
        File.WriteAllText(path, banco);

    }
    public void EnviarProBanco()// preparanmdo o json pra enviar
    {
        string save = File.ReadAllText(Application.persistentDataPath + "/arquivo.txt");// Application.persistentDataPath + "/arquivo.txt"; //
        //string url ="http://200.132.77.55/salvadados.php";
        string url = "http://teste.local.com/index.php";
        StartCoroutine(Enviar(save, url));

    }

    IEnumerator Enviar(string save, string url)
    {
        WWWForm formData = new WWWForm();
        formData.AddBinaryData("arquivo", System.Text.Encoding.UTF8.GetBytes(save));
        //Debug.Log(save);
        UnityWebRequest www = UnityWebRequest.Post(url,formData);
        yield return www.SendWebRequest();
        

        if  (www.result == UnityWebRequest.Result.ConnectionError)
        {
            erro = www.error;
            //Debug.Log(erro);
        }
        else
        {
            erro = "Form upload complete!";

            File.WriteAllText(Application.persistentDataPath + "/Jogos.txt"  , "");
            File.WriteAllText(Application.persistentDataPath + "/Jogadas.txt", "");
            File.WriteAllText(Application.persistentDataPath + "/arquivo.txt", "");
            //Debug.Log(erro);

            LimparArquivos();
            
        }

        www.Dispose();
        /*
         WWWForm form = new WWWForm();
         form.AddField("arquivo", json);

         using (UnityWebRequest www = UnityWebRequest.Post(url, form))
         {
             yield return www.SendWebRequest();

             if (www.isNetworkError || www.isHttpError)
             {
                 Debug.Log(www.error);
             }
             else
             {
                 Debug.Log("Form upload complete!");
                 File.Delete(Application.persistentDataPath + "/Jogos.txt");
                 File.Delete(Application.persistentDataPath + "/Jogadas.txt");

             }
         }*/
    }


    void LimparArquivos()
    {
        File.WriteAllText(Application.persistentDataPath + "/Jogos.txt", "");
        File.WriteAllText(Application.persistentDataPath + "/Jogadas.txt", "");
        File.WriteAllText(Application.persistentDataPath + "/arquivo.txt", "");
    }


}
[Serializable]
public class Numero
{
    public int numero;
}
//tupla jogo= , id  ,  dificuldade  ,  finalizado, pontos, problemas, abertos ,mascote, created, modified
//tupla jogada= ,id,dificuldade ,finalizado,pontos,problemas,abertos,mascote, created,modified 
