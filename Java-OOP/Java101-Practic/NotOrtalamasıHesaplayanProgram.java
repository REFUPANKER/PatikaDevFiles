import java.util.*;
public class App {
    public static void main(String[] args) throws Exception {
        Scanner sc1=new Scanner(System.in);
        Calc(new int[]{
            readInt(sc1,"Matematik Notu:"),
            readInt(sc1,"Fizik Notu:"),
            readInt(sc1,"Kimya Notu:"),
            readInt(sc1,"Turkce Notu:"),
            readInt(sc1,"Tarih Notu:"),
            readInt(sc1,"Muzik Notu:"),
        });
        sc1.close();
    }
    static void Calc(int notes[]){
        int all=0;
        for(int i=0;i<notes.length;i++)
        {
            all+=notes[i];
        }
        String calcResult=(all/notes.length>=60)? "Gecti" : "Kaldi";
        System.out.println("Sinif Durumu :"+calcResult+" Ortalama :"+all/notes.length);
         
    }
    static int readInt(Scanner sc,Object msg) {
        System.out.print(msg);
        return sc.nextInt();
    }
}
