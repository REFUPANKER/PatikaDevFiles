import java.util.*;
public class App {
    public static void main(String[] args) throws Exception {
        Scanner sc1=new Scanner(System.in);
        CalcKDV(
        readDouble(sc1, "Ucret Tutarini Girin :")
        );
        sc1.close();
    }
    static void CalcKDV(double price){
        if(price<1000)
        {
            cwl("KDV Orani : %18");
            cwl("KDV Payi :"+((price*0.18)));
            cwl("KDV li fiyat :"+(price+(price*0.18)));
        } else{
            cwl("KDV Orani : %8");
            cwl("KDV Payi :"+(price*0.08));
            cwl("KDV li fiyat :"+(price+(price*0.08)));
        }
    }
    static double readDouble(Scanner sc,Object msg) {
        System.out.print(msg);
        return sc.nextDouble();
    }
    static void cwl(Object msg) {
        System.out.println(msg);
    }
}
