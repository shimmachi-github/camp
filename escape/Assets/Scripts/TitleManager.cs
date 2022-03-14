using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.SceneManagement;

public class TitleManager : MonoBehaviour {

    public GameObject Panelload;

	// Use this for initialization
	void Start () {
		
	}
	
	// Update is called once per frame
	void Update () {
		
	}

    public void PushStarButton()
    {
        Panelload.SetActive(true);
        SceneManager.LoadScene("GameScene");
       
    }
}
