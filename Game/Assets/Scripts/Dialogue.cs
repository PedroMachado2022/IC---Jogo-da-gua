using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class Dialogue : MonoBehaviour
{   
    
    private GameObject obj_botao;          
    private botao script_botao;
    
    public Sprite profile;
    public string[] speechTx;
    public string actorName;

    public LayerMask playerLayer;
    public float radious;
    private DialogueControl dc;

    bool onRadious;

    private void Start(){
        dc = FindObjectOfType<DialogueControl>();

        obj_botao = GameObject.Find("Ação");          
        script_botao = obj_botao.GetComponent<botao>();
    }

    private void FixedUpdate(){
        Interact();
    }

    private void Update (){
        if(script_botao.acao == true && onRadious){
            dc.Speech(profile, speechTx, actorName);
            script_botao.acao = false;
        }
    }

    public void Interact(){
        Collider2D hit = Physics2D.OverlapCircle(transform.position, radious, playerLayer);

        if (hit != null){
            onRadious = true;
            script_botao.dentro = true;
        } else {
            onRadious = false;
            script_botao.dentro = false;
        }
    }

    private void OnDrawGizmosSelected(){
        Gizmos.DrawWireSphere(transform.position, radious);
    }
}
 
